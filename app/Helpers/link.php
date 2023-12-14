<?php

function getUrlPost($item, $is_amp = null, $google_amp = 1){

    $is_amp = $is_amp ?? IS_AMP;

    if(empty($item))

    {

        return '';

    }

    $slug = "$item->slug-p$item->id.html";

    if ($is_amp)

        $slug .= "?amp";

    $url = url($slug);

    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);

    return $url;

}

function getUrlCate($item, $is_amp = null, $google_amp = 1){

    $is_amp = $is_amp ?? IS_AMP;

    if(empty($item))

    {

        return '';

    }

    $slug = "$item->slug";

    if ($is_amp)

        $slug .= "?amp";

    $url = url($slug);

    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);

    return $url.'-7m/';

}

function getUrlTag($item, $is_amp = null, $google_amp = 1) {

    $is_amp = $is_amp ?? IS_AMP;

    $slug = "$item->slug-t$item->id";

    if ($is_amp)

        $slug .= "?amp";

    $url = url($slug);

    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);

    return $url;

}

function getUrlStaticPage($item, $is_amp = null, $google_amp = 1) {

    $is_amp = $is_amp ?? IS_AMP;

    $slug = "$item->slug-pt$item->id.html";

    if ($is_amp)

        $slug .= "?amp";

    $url = url($slug);

    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);

    return $url;

}

function getFullUrl($url, $is_amp = null, $google_amp = 1) {

    $parse = parse_url($url);

    $is_link_out = (isset($parse['host']) && $parse['host'] != env('DOMAIN'));

    if ($is_link_out) {

        return $url;

    } else {

        $is_amp = $is_amp ?? IS_AMP;

        $slug = $parse['path'];

        if ($is_amp)

            $slug .= "?amp";

        $url = url($slug);

        if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);

        return $url;

    }

}

function getUrlLink($slug, $is_amp = ''){

    if (!$is_amp)

        $is_amp = defined('IS_AMP') ? IS_AMP : 0;

    if (substr($slug, -1) != '/') $slug .= '/';

    if ($is_amp) $slug .= "amp";

    return url($slug).'/';

}

function getUrlPage($page) {

    $parts = parse_url($_SERVER['REQUEST_URI']);

    parse_str($parts['query'], $query);

    $query['page'] = $page;

    return $parts['path'].'?'.http_build_query($query);

}

function isLinkOut($url) {

    $parse = parse_url($url);

    return (isset($parse['host']) && $parse['host'] != env('DOMAIN'));

}

function tableOfContent($content) {

    preg_match_all("/<h[23456].*?<\/h[23456]>/",$content,$patt);

    if (empty($patt[0])) return $content;

    $patt2 = $patt[0];

    $index_h2 = 0;

    $index_h3 = 1;

    $danhmuc = "<div class='w-100 border py-2 px-3 mb-3'>

                    <p class='mb-2 d-flex align-items-center summary-title'>

                        <span class=\"square-blue mr-2\"></span>

                        <span class='font-weight-bold font-20 text-green5 w-100 collapsible'>NỘI DUNG CHÍNH</span>

                    </p>";

    $danhmuc .= "<ul class='list-unstyled mb-2'>";



    foreach ($patt2 as $key=>$item){

        $contentItem = strip_tags($item);

        $slug = toSlug($contentItem,'-');

        if (strpos($item, '</h2>') !== false) {

            $index_h2++;

            $danhmuc .= "<li rel='dofollow' class='mb-1'><a class='text-black1 font-15' href='#$slug' >$index_h2. ".$contentItem."</a></li>";

            $index_h3 = 1;

        } else {

            $danhmuc .= "<li rel='dofollow' class='mb-1 pl-3'><a class='text-black1 font-15' href='#$slug' >$index_h2.$index_h3. ".$contentItem."</a></li>";

            $index_h3++;

        }

        $head = substr($item,0,3);

        $tail = substr($item,3);



        $id = " id='$slug'";

        $content = str_replace($item,$head.$id.$tail,$content);

    }

    $danhmuc .= "</ul></div>";

    $content = "$danhmuc<div class='post-content text-justify'>$content</div>";

    return $content;

}

?>

