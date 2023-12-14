<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\Category;
use App\Models\Post_Category;
use Illuminate\Http\Request as HttpRequest;
use Route;

class CategoryController extends Controller
{
    public function index() {
        $listItem = Category::all();
        foreach ($listItem as $key => $item) {
            $listItem[$key]->count_post = Post_Category::where('category_id', $item->id)->count();
        }
        $data['listItem'] = $listItem;
        return view('admin.category.index', $data);
    }

    public function update($id = 0) {
        $data['categoryTree'] = Category::getTree();
        if ($id > 0) $data['oneItem'] = $oneItem = Category::findOrFail($id);

        if (!empty(Request::post())) {
            $request = Request::post();
            $request['title_children'] = json_encode($request['title_children']);
            Category::updateOrInsert(['id' => $id], $request);
            return Redirect::to('/admin/category');
        }
        return view('admin.category.update', $data);
    }

    public function delete($id) {
        Category::destroy($id);
        return back();
    }

    public function exportExcel(HttpRequest $request)
    {
        $categories = Category::select('id', 'title', 'slug')->orderBy('id', 'desc')->get();
        $dataExport = [];
        $url = url('/');
        $dataExport[] = ['ID', 'Tiêu đề', 'Slug'];
        foreach($categories as $key => $category)
        {
            $key++;
            $dataExport[$key]['id'] = $category->id;
            $dataExport[$key]['title'] = $category->title;
            $dataExport[$key]['slug'] = "$url/$category->slug-c$category->id";;
        }
        return collect($dataExport)->downloadExcel('danh-muc.xlsx');
    }
}
