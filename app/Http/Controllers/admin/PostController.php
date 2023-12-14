<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternalLink;
use App\Models\Match;
use App\Models\User;
use Request;
use Redirect;
use App\Models\Post;
use App\Models\Category;
use App\Models\ComputerPredict;
use App\Models\Post_tag;
use App\Models\Post_Category;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Traits\GoogleIndexing;
class PostController extends Controller
{
    // use GoogleIndexing;

    public function index() {
        $limit = 10;
        $count = Post::count();
        $pagination = (int) ceil($count/$limit);
        #
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        #
        $condition = [];
        if (isset($_GET['status'])) {
            $condition[] = ['status', $_GET['status']];
        }
        if (!empty($_GET['hen_gio'])) {
            $condition[] = ['displayed_time', '>', Post::raw('NOW()')];
        } elseif (!empty($_GET['status'])) {
            $condition[] = ['displayed_time', '<=', Post::raw('NOW()')];
        }
        if (!empty($_GET['keyword'])) {
            $condition[] = ['slug', 'LIKE', '%'.toSlug($_GET['keyword']).'%'];
        }
        if (!empty($_GET['category_id'])) {
            $condition[] = ['category_id', $_GET['category_id']];
        }
        if (!empty($_GET['user_id'])) {
            $condition[] = ['user_id', $_GET['user_id']];
        }
        #
        $data['categoryTree'] = Category::getTree();
        $data['listUser'] = User::where('status', 1)->get();
        #
        $listItem = Post::with('categories')->with('tags')->where($condition)->orderBy('displayed_time', 'DESC')->offset(($page-1)*$limit)->limit($limit)->get();

        $data['total'] = Post::where($condition)->count();
        foreach ($listItem as $key => $item) {
            $listItem[$key]->count_link_ve = InternalLink::where('post_id_out', $item->id)->count();
        }

        $data['listItem'] = $listItem;
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        return view('admin.post.index', $data);
    }

    public function update($id = 0) {
        $data['categoryTree'] = Category::getTree();
        $data['user_id'] = Auth::id();
        $data['group_id'] = Auth::user()->group_id;

        if ($id > 0) {
            $data['oneItem'] = $oneItem = Post::findOrFail($id);
            if (!empty($oneItem->id_bongdalu) || !empty($oneItem->id_match))
                if($oneItem->id_bongdalu){
                    $data['match'] = Match::where('id_bongdalu', $oneItem->id_bongdalu)->first();
                }
                elseif($oneItem->id_match){
                    $data['match'] = Match::where('id', $oneItem->id_match)->first();
                }

                if(isset($data['match']->id))
                {
                    $data['computerPredict'] = ComputerPredict::where('match_id', $data['match']->id)->first();
                }
        }
        if (!empty(Request::post())) {
            $post_data = Request::post();

            if (empty($post_data['slug'])) $post_data['slug'] = toSlug($post_data['title']);
            if (!empty($post_data['tag'])) {
                $post_tag = $post_data['tag'];
                unset($post_data['tag']);
            }

            if (!empty($post_data['content']))
            {
                preg_match_all("/<h[3].*?<\/h[3]>/",$post_data['content'], $tagH3);
                preg_match_all("/<h[2].*?<\/h[2]>/",$post_data['content'], $tagH2);

                if(isset($tagH3[0][0])) // Dự đoán trận đấu
                {
                    $title = strip_tags($tagH3[0][0]);
                    $nailh3 = toSlug($title);
                    $post_data['predict_score'] = $nailh3;
                }

                if (isset($tagH2[0][0]))
                {
                    $title = strip_tags($tagH2[0][0]);
                    $nailh2 = toSlug($title);
                    $post_data['view_tournament'] = $nailh2;
                }
            }

            if (!empty($post_data['category'])) {
                $post_category = $post_data['category'];
                unset($post_data['category']);
                $post_data['category_id'] = $post_category[0];
            }

            $post_data['count_link_out'] = getNumberLinkOut($post_data['description'].$post_data['content']);

            if (!empty($post_data['id_bongdalu']) || !empty($post_data['match']['scheduled'])){
                $post_data['match']['id_bongdalu'] = $post_data['id_bongdalu'];
                if($post_data['id_bongdalu'])
                {
                    $match = Match::where('id_bongdalu', $post_data['id_bongdalu'])->first();
                }elseif($post_data['id_match'])
                {
                    $match = Match::where('id', $post_data['id_match'])->first();
                }

                if(isset($match) && $match->crawl_status == 'pending')
                {
                    $match->update($post_data['match']);
                }

                if(!isset($match))
                {
                   $match = new Match;
                   $match->fill($post_data['match']);
                   $match->save();
                }

                if(!empty($post_data['computerPredict']) && isset($match->id))
                {
                    ComputerPredict::updateOrInsert(['match_id' => $match->id], $post_data['computerPredict']);
                }
                $post_data['id_match'] = $match->id;
            }
            unset($post_data['match']);
            unset($post_data['computerPredict']);

            if ($id > 0) {
                Post::where('id', $id)->update($post_data);
                Post_tag::where('post_id', $id)->delete();
                Post_Category::where('post_id', $id)->delete();
            } else {
                $id = Post::insertGetId($post_data);
            }
            if (!empty($post_tag)) {
                foreach ($post_tag as $item) {
                    Post_tag::insert(['post_id' => $id, 'tag_id' => $item]);
                }
            }

            if (!empty($post_category)) {
                foreach ($post_category as $key => $item) {
                    if ($key == 0)
                        Post_Category::insert(['post_id' => $id, 'category_id' => $item, 'is_primary' => 1]);
                    else
                        Post_Category::insert(['post_id' => $id, 'category_id' => $item]);
                }
            }

            InternalLink::updateData($id, $post_data['description'].$post_data['content']);

            return Redirect::to('/admin/post?status=1');
        }
        return view('admin.post.update', $data);
    }

    public function delete($id) {
        $post = Post::find($id);
        Post_tag::where('post_id', $id)->delete();
        Post_Category::where('post_id', $id)->delete();
        if(isset($post->id_bongdalu))
        {
            $match = Match::where('id_bongdalu', $post->id_bongdalu)->first();
        }
        if(isset($post->id_match))
        {
            $match = Match::where('id', $post->id_match)->first();
        }

        if(isset($match->id))
        {
            ComputerPredict::where('match_id', $match->id)->delete();
            $match->delete();
        }
        $post->delete();
        return back();
    }

    public function exportExcel(HttpRequest $request)
    {
        $posts = Post::select('id', 'title', 'slug', 'displayed_time')
                    ->with(['categories', 'tags'])
                    ->orderBy('id', 'desc')
                    ->where('status', $request->status);
        if(!empty($request->keyword))
        {
            $posts = $posts->where('title', 'like', "%$request->keyword%");
        }
        if(!empty($request->category_id))
        {
            $categoryId = $request->category_id;
            $posts = $posts->whereHas('categories', function ($query) use ($categoryId){
                $query->where('id', $categoryId);
            });
        }
        if(!empty($request->user_id))
        {
            $posts = $posts->where('user_id', $request->user_id);
        }

        $posts = $posts->get();
        $data = array();
        $url = url('/');

        $data = [];
        $data[] = ['id', 'Tiêu đề', 'Slug', 'Chuyên mục', 'Tag'];
        foreach($posts as $key => $post)
        {
            $key++;
            $data[$key]['id'] = $post->id;
            $data[$key]['title'] = $post->title;
            $data[$key]['slug'] = "$url/$post->slug-p$post->id.html";
            $data[$key]['categories'] = $this->listTitleToStr($post->categories);
            $data[$key]['tags'] = $this->listTitleToStr($post->tags);
        }
        return collect($data)->downloadExcel('bai-viet.xlsx');
    }

    public function listTitleToStr($listItem)
    {
        $str = "";
        foreach ($listItem as $item)
        {
            $str .= "$item->title - ";
        }
        $str = trim($str, '- ');
        return $str;
    }
}
