<?php



namespace App\Http\Controllers\web;



use App\Models\Category;

use App\Models\Post;

use App\Http\Controllers\WebController;

use Illuminate\Support\Facades\Redirect;



class CategoryController extends WebController

{

    public function index($slug, $page = 1) {

        $oneItem = Category::getBySlug($slug);

        if (empty($oneItem) || $oneItem->status == 0) {

            return Redirect::to(url('404.html'));

        }

        $data = [];

        $data['oneItem'] = $oneItem;

        if ($oneItem->slug != $slug) return Redirect::to(getUrlCate($oneItem), 301);

        $data['seo_data'] = initSeoData($oneItem,'category');



        $limit = 25;



        $params = [

            'category_id' => $oneItem->id,

            'limit' => $limit,

            'offset' => ($page-1) * $limit,

        ];



        $data['post'] = Post::getPosts($params);



        $data['page'] = $page;



        $breadCrumb = [];

        $breadCrumb[] = [

            'name' => $oneItem->title,

            'item' => getUrlCate($oneItem),

            'schema' => true,

            'show' => true

        ];



        $data['breadCrumb'] = $breadCrumb;



        $data['schema'] = getSchemaBreadCrumb($breadCrumb);
        return view('web.category.index', $data);

    }



    public function loadMorePost($categoryId, $page)

    {

        $limit = 25;



        $params = [

            'category_id' => $categoryId,

            'limit' => $limit,

            'offset' => $page * $limit,

        ];



        $count = Post::getCount($params);

        $pagination = (int) ceil($count/$limit);

        $data['pagination'] = $pagination;

        $data['page'] = $page;



        $data['post'] = Post::getPosts($params);



        if($data['post']->isEmpty())

        {

            return response()->json(['status' => 204, 'data' => null]);

        }

        $html = view('web.block._load_more_post', $data)->render();



        return response()->json(['status' => 200, 'data' => $html]);

    }

}

