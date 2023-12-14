<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Da_ga;
use App\Models\Post;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use App\Http\Controllers\WebController;

class RssController extends WebController
{
    public function index() {
        $data['categories'] = Category::all();
        return view('web.rss.index', $data);
    }

    function home() {
        $posts = Post::where(['status' => 1, ['displayed_time', '<=', Post::raw('NOW()')]])->orderBy('displayed_time', 'DESC')->limit(50)->get();

        $rss = '<?xml version="1.0" encoding="utf-8" ?>';
        $rss .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
        $rss .= '<channel>';
        $rss .= '<title>7mcn88</title>';
        $rss .= '<copyright>7mcn88</copyright>';
        $rss .= '<link>'.url('/').'</link>';
        $rss .= '<description>'.strip_quotes(getSiteSetting('site_description')).'</description>';
        $rss .= '<language>vi-vn</language>';
        $rss .= '<pubDate>'.date("D, d M Y H:i:s O").'</pubDate>';
        $rss .= '<lastBuildDate>'.date("D, d M Y H:i:s O").'</lastBuildDate>';
        $rss .= '<docs>'.url('rss-feed').'</docs>';
        $rss .= '<managingEditor>7mcn88@gmail.com (7mcn88)</managingEditor>';
        $rss .= '<webMaster>7mcn88@gmail.com (7mcn88)</webMaster>';
        $rss .= '<ttl>5</ttl>';
        $rss .= '<image>';
        $rss .= '<url>'.env('SITE_LOGO').'</url>';
        $rss .= '<title>7mcn88</title>';
        $rss .= '<link>'.url('/').'</link>';
        $rss .= '</image>';
        $rss .= '<atom:link href="'.url('/rss/home.rss').'" rel="self" type="application/rss+xml" />';
        foreach ($posts as $post) {
            $rss .= '<item>';
            $rss .= '<title><![CDATA[ '.$post->title.' ]]></title>';
            $rss .= '<description><![CDATA[ <a href="'.getUrlPost($post).'"><img width="180px" border="0" src="'.($post->thumbnail ? getThumbnail($post->thumbnail) : env('SITE_LOGO')).'" align="left" hspace="5" /></a><div>'.html_entity_decode($post->description, ENT_QUOTES, 'UTF-8').'</div> ]]></description>';
            $rss .= '<link>'.getUrlPost($post).'</link>';
            $rss .= '<pubDate>'.date("D, d M Y H:i:s O", strtotime($post->displayed_time)).'</pubDate>';
            $rss .= '<guid>'.getUrlPost($post).'</guid>';
            $rss .= '<atom:link href="'.url('/rss/home.rss').'" rel="self" type="application/rss+xml" />';
            $rss .= '</item>';
        }
        $rss .= '</channel>';
        $rss .= '</rss>';
        header("Content-Type: text/xml; charset=utf-8");
        echo $rss;
    }

    public function detail($slug) {
        $category = Category::where('slug', $slug)->first();
        $params = [
            'category_id' => $category->id,
            'limit' => 50,
        ];
        if($category->id == 25){
            $now = Carbon::now();
            $posts = Da_ga::where('status', 1)
            ->where('displayed_time', '<=', $now)
            ->orderBy('displayed_time', 'desc')
            ->limit($params['limit'])->get();
        }else{
            $posts = Post::getPosts($params);
        }
        $rss = '<?xml version="1.0" encoding="utf-8" ?>';
        $rss .= '<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        >';
        //sitemap category
        $rss .= '<channel>';
        $rss .= '<title>'.strip_tags(html_entity_decode($category->description, ENT_QUOTES, 'UTF-8')).' | 7mcn88</title>';
        $rss .= '<atom:link href="'.url("rss/".$category->slug.".rss").'" rel="self" type="application/rss+xml" />';
        $rss .= '<link>'.getUrlCate($category).'</link>';
        $rss .= '<description>'.htmlspecialchars(strip_tags(html_entity_decode($category->content, ENT_QUOTES, 'UTF-8'))).'</description>';
        $rss .= '<lastBuildDate>'.date("D, d M Y H:i:s O").'</lastBuildDate>';
        $rss .= '<language>vi-vn</language>';
        $rss .= '<sy:updatePeriod>hourly</sy:updatePeriod><sy:updateFrequency>1</sy:updateFrequency>';
        $rss .= '<image>';
        $rss .= '<url>'.env('SITE_LOGO').'</url>';
        $rss .= '<title>'.$category->title.' | 7mcn88</title>';
        $rss .= '<link>'.getUrlCate($category).'</link>';
        $rss .= '<width>144</width>';
        $rss .= '<height>50</height>';
        $rss .= '</image>';
        $rss .= '<pubDate>'.date("D, d M Y H:i:s O").'</pubDate>';
        $rss .= '<docs>'.url('rss-feed').'</docs>';
        foreach ($posts as $post) {
            $rss .= '<item>';
            $rss .= '<title><![CDATA[ '.$post->title.' ]]></title>';
            $rss .= '<description><![CDATA[ <a href="'.getUrlPost($post).'"><img width="180px" border="0" src="'.getThumbnail($post->thumbnail).'" align="left" hspace="5" /></a><div>'.html_entity_decode($post->description, ENT_QUOTES, 'UTF-8').'</div> ]]></description>';
            $rss .= '<content:encoded><![CDATA[ '.html_entity_decode(content_rss_replace($post->content), ENT_QUOTES, 'UTF-8').' ]]></content:encoded>';
            $rss .= '<link>'.getUrlPost($post).'</link>';
            $rss .= '<pubDate>'.date("D, d M Y H:i:s O", strtotime($post->displayed_time)).'</pubDate>';
            $rss .= '<guid>'.getUrlPost($post).'</guid>';
            $rss .= '<atom:link href="'.getUrlPost($post).'" rel="self" type="application/rss+xml" />';
            $rss .= '</item>';
        }

        $rss .= '</channel>';
        $rss .= '</rss>';
        header("Content-Type: text/xml; charset=utf-8");
        echo $rss;
    }
}
