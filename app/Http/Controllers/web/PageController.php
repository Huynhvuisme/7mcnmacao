<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Page;
use App\Models\Post;
use App\Models\Menu;
use App\Models\Nha_Cai;
use App\Models\SiteSetting;
use App\Http\Controllers\WebController;
use App\Models\Crawler;

class PageController extends WebController
{
    const LIST_KEO = [
        14 => 'ngoai-hang-anh',
        16 => 'la-liga',
        20 => 'v-league',
        17 => 'ligue-1',
        19 => 'bundesliga',
        18 => 'serie-a',
        21 => 'cup-c1-chau-au',
        22 => 'cup-c2-chau-au',
        23 => 'uefa-europa-conference-league',
        24 => 'world-cup'
    ];

    public function index($slug, $id) {
        $oneItem = Page::find($id);
        if (empty($oneItem) || $oneItem->status == 0)
            return Redirect::to(url('404.html'));
        if ($oneItem->slug != $slug) return Redirect::to(getUrlStaticPage($oneItem), 301);

        $view = 'index';
        $amphtml = 1;
        if ($id == 1) { // Page tỷ lệ kèo
            // $data['data'] = getTylekeo();
            $data['data'] = IS_MOBILE ? getTylekeoMobile() : getTylekeo();
            $view = 'ty_le_keo';
            $menu = Menu::find(11); // ty le keo menu
            $data['category_menu'] = empty($menu->data) ? [] : json_decode($menu->data);
            $amphtml = 0;
        } elseif ($id == 3) { // Máy tính dự đoán
            $data['dataCrawl'] = Crawler::where('page', 'may-tinh-du-doan-bong-da')->first();
            $data['spin_match'] = Post::get_list_match(['limit' => -1, 'computerPredict' => true, 'category_ids' => array(1)]);
            $view = 'may_tinh_chon_keo';
            $amphtml = 0;
        } elseif ($id == 25) {  // Page tỷ lệ ma cao
            $data['data'] = getTylekeo();
            $view = 'ty_le_ma_cao';
            $amphtml = 0;
        } elseif(in_array($id, array_keys(self::LIST_KEO))) {
            $data['dataCrawl'] = Crawler::where('page', self::LIST_KEO[$oneItem->id])->first();
            $menu = Menu::find(10); // page menu
            $data['page_menu'] = empty($menu->data) ? [] : json_decode($menu->data);
            $view = 'list_soi_keo';
            $amphtml = 0;
        }

        $data['oneItem'] = $oneItem;

        $breadCrumb = [];
        $breadCrumb[] = [
            'name' => $oneItem->title,
            'item' => getUrlStaticPage($oneItem),
            'schema' => true,
            'show' => true
        ];

        $data['breadCrumb'] = $breadCrumb;

        $data['schema'] = getSchemaBreadCrumb($breadCrumb);

        $data['seo_data'] = initSeoData($oneItem, 'page', $amphtml);

        return view('web.page.'.$view, $data);
    }

    private function daGa($content, $short_code, $url) {
        return str_replace($short_code, initVideo($url), $content);
    }

    private function parse_content($content) {
        $array_str_remove = array(
            'background-color: #EEEEEE;'
        );
        $content = str_replace($array_str_remove, '', $content);
        return $content;
    }

    public function not_found() {
        abort(404);
    }

    public function any() {
        return Redirect::to(url('404.html'));
    }
}
