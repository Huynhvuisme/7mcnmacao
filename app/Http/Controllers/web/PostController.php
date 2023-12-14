<?php

namespace App\Http\Controllers\web;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Post_tag;
use App\Http\Controllers\WebController;

class PostController extends WebController
{
    public function index($slug, $id) {
        $oneItem = Post::with('tags')->findOrFail($id);
        if (empty($oneItem) || $oneItem->status == 0 || strtotime($oneItem->displayed_time) > time())
        {
            $user = Auth::user();
            if(empty($user))
                abort(404);
            $group = Group::find($user->group_id);
            $permission = json_decode($group->permission, 1);
            if(empty($permission['post']['index']))
                abort(404);

        }
        if ($oneItem->slug != $slug) return Redirect::to(getUrlPost($oneItem), 301);
        $oneItem->content = $this->parse_content($oneItem->content);
        $data['oneItem'] = $oneItem;
        $data['category'] = $category = Category::find($oneItem->category_id);
        if (!empty($oneItem->optional))
            $data['optional'] = json_decode($oneItem->optional);
        if (!empty($oneItem->id_bongdalu))
            // $data['match'] = Match::where('id_bongdalu', $oneItem->id_bongdalu)->get()->first();
        $data['tags'] = Post_tag::leftjoin('tag', 'tag_id', '=', 'id')->where('post_id', $id)->get();
        $data['related_post'] = Post::where(['status' => 1, 'category_id' => $oneItem->category_id, ['displayed_time', '<=', Post::raw('NOW()')], ['id', '<>', $id]])->orderBy('displayed_time', 'DESC')->limit(4)->get();
        $data['seo_data'] = initSeoData($oneItem, 'post');


        $breadCrumb = [];

        if (!empty($category) && !empty($oneItem->id_bongdalu) && in_array($category->id, [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,18])) {
            $params = [
                'limit' => 1,
                'category_id' => $category->id,
                'order_by' => ['match.scheduled' => 'DESC'],
                'scheduled_before' => $data['match']->scheduled ?? '',
                'not_in' => ['post.id' => [$id]]
            ];
            $data['extra_post_before'] = Post::get_list_match($params);
            $params = [
                'limit' => 2,
                'category_id' => $category->id,
                'order_by' => ['match.scheduled' => 'ASC'],
                'scheduled_after' => $data['match']->scheduled ?? ''
            ];
            if (!empty($data['extra_post_before'][0]))
                $params['not_in'] = ['post.id' => [$data['extra_post_before'][0]->id, $id]];
            $data['extra_post_after'] = Post::get_list_match($params);
        }

        $breadCrumb[] = [
            'name' => $category->title ?? '',
            'item' => getUrlCate($category),
            'schema' => false,
            'show' => true
        ];
        $breadCrumb[] = [
            'name' => $oneItem->title ?? '',
            'item' => getUrlPost($oneItem),
            'schema' => true,
            'show' => false
        ];

        $data['breadcrumb'] = $breadCrumb;

        $data['schema'] = getSchemaBreadCrumb($breadCrumb);

        return view('web.post.index', $data);
    }
    private function parse_content($content) {
        return $content;
    }
}
