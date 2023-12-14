<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\Tag;
use Illuminate\Http\Request as HttpRequest;

class TagController extends Controller
{
    public function index(HttpRequest $request) {
        $keyWord = isset($request->keyword) ? $request->keyword : '' ;
        $data['listItem'] = Tag::where("title", "like", "%$keyWord%")->paginate(10);
        $data['listItem']->appends(['keyword' => $keyWord]);
        return view('admin.tag.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        if ($id > 0) $data['oneItem'] = $oneItem = Tag::findOrFail($id);
        if (!empty(Request::post())) {
            $post_data = Request::post();
            $post_data['slug'] = toSlug($post_data['title']);
            Tag::updateOrInsert(['id' => $id], $post_data);
            return Redirect::to('/admin/tag');
        }
        return view('admin.tag.update', $data);
    }

    public function delete($id) {
        Tag::destroy($id);
        return back();
    }


    public function exportExcel(HttpRequest $request )
    {
        $tags = Tag::select('id', 'title', 'slug')
                    ->orderBy('id', 'desc');
        if(!empty($request->keyword))
        {
            $tags = $tags->where('title', 'like', "%$request->keyword%");
        }
        $tags = $tags->get();
        $dataExport = [];
        $dataExport[] = ['ID', 'Tiêu đề', 'Slug'];
        $url = url('/');
        foreach ($tags as $key => $tag)
        {
            $key++;
            $dataExport[$key]['id'] = $tag->id;
            $dataExport[$key]['title'] = $tag->title;
            $dataExport[$key]['slug'] = "$url/$tag->slug-t$tag->id";
        }
        return collect($dataExport)->downloadExcel('tag.xlsx');
    }
}
