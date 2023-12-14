<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\WebController;
class TagController extends WebController
{

    const LIMIT_POSTS = 10;

    public function index($slug, $id)
    {
        $data['page'] = 1;
        $data['tag'] = Tag::findOrFail($id);
        $data['post'] = Post::with('category', 'tags')
                    ->whereHas('tags', function($query) use ($id){
                        $query->where('id', $id);
                    })
                    ->where('status', 1)
                    ->where('displayed_time', '<=', now())
                    ->orderBy('displayed_time', 'desc')
                    ->limit(self::LIMIT_POSTS)
                    ->offset(0)
                    ->get();
        $breadCrumb = [];
        
        $breadCrumb[] = [
            'name' => $data['tag']->title,
            'item' => getUrlTag($data['tag']),
            'schema' => true,
            'show' => true
        ];
        $data['seo_data'] = initSeoData($data['tag'], 'tag');
        $data['breadCrumb'] = $breadCrumb;

        return view('web.tag.index', $data);
    }

    public function loadMorePosts($tagId, $page)
    {
        $data['post'] = Post::with('category', 'tags')
                            ->whereHas('tags', function($query) use ($tagId){
                                $query->where('id', $tagId);
                            })
                            ->where('status', 1)
                            ->where('displayed_time', '<=', now())
                            ->orderBy('displayed_time', 'desc')
                            ->limit(self::LIMIT_POSTS)
                            ->offset($page*self::LIMIT_POSTS)
                            ->get();

        if($data['post']->isEmpty())
        {
            return response()->json(['status' => 204, 'data' => null]);
        }
        $html = view('web.block._load_more_post', $data)->render();

        return response()->json(['status' => 200, 'data' => $html]);
    }
}
