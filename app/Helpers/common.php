<?php
function toSlug($doc)
{
    $str = addslashes(html_entity_decode($doc));
    $str = trim($str);
    $str = toNormal($str);
    $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $str = preg_replace("/( )/", '-', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace("\/", '', $str);
    $str = str_replace("+", "", $str);
    $str = strtolower($str);
    $str = stripslashes($str);
    return trim($str, '-');
}

function toNormal($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    return $str;
}

function get_limit_content($string, $length = 255)
{
    $string = strip_tags($string);
    if (strlen($string) > 0) {
        $arr = explode(' ', $string);
        $return = '';
        if (count($arr) > 0) {
            $count = 0;
            if ($arr) foreach ($arr as $str) {
                $count += strlen($str);
                if ($count > $length) {
                    $return .= "...";
                    break;
                }
                $return .= " " . $str;
            }
            $return = closeTags($return);
        }
        return $return;
    } else {
        return '';
    }
}

function closeTags($html){
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openEdTags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedTags = $result[1];
    $len_opened = count($openEdTags);
    if (count($closedTags) == $len_opened) {
        return $html;
    }
    $openEdTags = array_reverse($openEdTags);
    for ($i = 0; $i < $len_opened; $i++) {
        if (!in_array($openEdTags[$i], $closedTags)) {
            $html .= '</' . $openEdTags[$i] . '>';
        } else {
            unset($closedTags[array_search($openEdTags[$i], $closedTags)]);
        }
    }
    return $html;
}

function getListPermission() {
    return [
        'category' => 'Chuyên mục',
        'post' => 'Bài viết',
        'page' => 'Page tĩnh',
        'tag' => 'Tag',
        'nha_cai' => 'Nhà cái',
        'featuredpost' => 'Bài viết nổi bật',
        'user' => 'Thành viên',
        'group' => 'Nhóm quyền',
        'site_setting' => 'Cài đặt chung',
        'redirect' => 'Cấu hình Redirect',
        'menu' => 'Cấu hình Menu',
        'football_league' => 'Giải nổi bật',
        // 'banner' => 'Banner',
        'da_ga' => 'Bài viết đá gà',
        'categoryauthor' => 'Tác giả chuyên mục',
        'imageManagement' => 'Quản lý ảnh'
    ];
}

function getCurrentController() {
    $controller = class_basename(Route::current()->controller);
    return strtolower(str_replace('Controller', '', $controller));
}

function getCurrentAction() {
    return class_basename(Route::current()->getActionMethod());
}

function getCurrentParams() {
    return Route::current()->parameters();
}

function getCurrentControllerTitle() {
    $controller = getCurrentController();
    $listPermission = getListPermission();
    return !empty($listPermission[$controller]) ? $listPermission[$controller] : '';
}

function getSiteSetting($key) {
    $siteSetting = config('siteSetting');
    if(!$siteSetting){
        $siteSetting = \App\Models\SiteSetting::get();
        config(['siteSetting' => $siteSetting]);
    }
    $value = $siteSetting->where('setting_key', $key)->first();
    if(isset($value))
    {
        return $value->setting_value;
    }
    return "";
}

function strip_quotes($str)
{
    return str_replace(array('"', "'"), '', $str);
}

function genImage($src, $width, $height, $title = false, $class = 'img-fluid', $lazy = true) {
    if (!IS_AMP){
        if ($lazy)
            $lazy = " loading=\"lazy\"";
        $src = getThumbnail($src, $width, $height);
        $img = "<img $lazy src='$src' alt='$title' class='$class' width='$width' height='$height'>";
    } else {
        $img = "<amp-img class='$class' src='$src' alt='".str_replace('\'', '"', $title)."' width='$width' height='$height' layout='responsive'></amp-img>";
    }

    return $img;
}

function getThumbnail($image_url, $width = '', $height = ''){
    $source_file = public_path().$image_url;
    if (!file_exists($source_file)){
        return $image_url;
    }

    //return url($image_url);
    //check file exist
    if (empty($width) || empty($height))
        return url($image_url);

    $source_file = str_replace('//','/',$source_file);

    $image_name = substr($image_url, 0, strrpos($image_url, '.'));
    $image_ext = substr($image_url, strrpos($image_url, '.'));

    $resize_image_name = $image_name.'-'.$width.'x'.$height.$image_ext;
    $resize_image_file = public_path().'/thumb'.$resize_image_name;
    $resize_image_url = url('thumb'.$resize_image_name);

    if(file_exists($resize_image_file)){
        $img_src = $resize_image_url;
    }else{
        resize_crop_image($width, $height, $source_file, $resize_image_file);
        if(file_exists($resize_image_file)){
            $img_src = $resize_image_url;
        }else{
            $img_src = $image_url;
        }
    }

    return $img_src;
}

function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    try {
        $imgSize = getimagesize($source_file);
        $width = $imgSize[0];
        $height = $imgSize[1];
        $mime = $imgSize['mime'];

        switch ($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width) {
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        } else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $folderPath = substr($dst_dir, 0, strrpos($dst_dir, '/'));
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img) imagedestroy($dst_img);
        if ($src_img) imagedestroy($src_img);
    } catch (Exception $e) {

    }
}

function initSeoData($item = '', $type = 'home', $amphtml = 0){
    switch ($type) {
        case 'category':
            $data_seo = [
                'meta_title' => strip_quotes($item->meta_title),
                'meta_keyword' => $item->meta_keyword,
                'meta_description' => strip_quotes($item->meta_description),
                'site_image' => $item->thumbnail,
                'canonical' => getUrlCate($item, 0),
                'amphtml' => getUrlCate($item, 1, 0),
                'index' => !empty($item->status) ? 'index,follow' : 'noindex,nofollow',
            ];
            break;
        case 'tag':
            $data_seo = [
                'meta_title' => strip_quotes($item->meta_title),
                'meta_keyword' => $item->meta_keyword,
                'meta_description' => strip_quotes($item->meta_description),
                'site_image' => getSiteSetting('site_logo'),
                'canonical' => getUrlTag($item, 0),
                'amphtml' => getUrlTag($item, 1, 0),
                'index' => 'index,follow',
            ];
            break;
        case 'page':
            $data_seo = [
                'meta_title' => strip_quotes($item->meta_title),
                'meta_keyword' => $item->meta_keyword,
                'meta_description' => strip_quotes($item->meta_description),
                'site_image' => $item->thumbnail,
                'canonical' => getUrlStaticPage($item, 0),
                'index' => !empty($item->status) ? 'index,follow' : 'noindex,nofollow',
                'published_time' => !empty($item->created_time) ? date('Y-m-d\TH:i:s',strtotime($item->created_time) - 1800) : '',
                'modified_time' => !empty($item->created_time) ? date('Y-m-d\TH:i:s',strtotime($item->created_time)) : '',
                'updated_time' => !empty($item->updated_time) ? date('Y-m-d\TH:i:s',strtotime($item->updated_time)) :''
            ];
            if ($amphtml) $data_seo['amphtml'] = getUrlStaticPage($item, 1, 0);
            break;
        case 'post':
            $data_seo = [
                'meta_title' => strip_quotes($item->meta_title),
                'meta_keyword' => $item->meta_keyword,
                'meta_description' => strip_quotes($item->meta_description),
                'site_image' => $item->thumbnail,
                'canonical' => getUrlPost($item, 0),
                'amphtml' => getUrlPost($item, 1, 0),
                'index' => !empty($item->meta_robot) ? 'index,follow' : 'noindex,nofollow',
                'published_time' => !empty($item->created_time) ? date('Y-m-d\TH:i:s',strtotime($item->created_time) - 1800) : '',
                'modified_time' => !empty($item->created_time) ? date('Y-m-d\TH:i:s',strtotime($item->created_time)) : '',
                'updated_time' => !empty($item->updated_time) ? date('Y-m-d\TH:i:s',strtotime($item->updated_time)) :''
            ];
            break;
        case 'home':
            $data_seo = [
                'meta_title' => strip_quotes(getSiteSetting('site_meta')),
                'meta_keyword' => '',
                'meta_description' => strip_quotes(getSiteSetting('site_description')),
                'site_image' => getSiteSetting('site_logo'),
                'canonical' => env('APP_URL').'/',
                'amphtml' => env('APP_URL').'/'.'?amp',
                'index' => 'index, follow',
                'published_time' => '',
                'modified_time' => '',
                'updated_time' => ''
            ];
            break;
        default:
            $data_seo = [
                'meta_title' => strip_quotes(getSiteSetting('site_meta')),
                'meta_keyword' => '',
                'meta_description' => strip_quotes(getSiteSetting('site_description')),
                'site_image' => getSiteSetting('site_logo'),
                'canonical' => url()->current(),
                'index' => 'index, follow',
                'published_time' => '',
                'modified_time' => '',
                'updated_time' => ''
            ];
            break;
    }
    return $data_seo;
}

function isMobile() {
    if (!isset($_SERVER["HTTP_USER_AGENT"])) return false;
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function getDataAPIPost($url, $data = []){
    $resource = curl_init();
    curl_setopt($resource, CURLOPT_URL, $url);
    curl_setopt($resource, CURLOPT_POST, true);
    curl_setopt($resource, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($resource, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($resource,CURLOPT_TIMEOUT,10);

    $response = curl_exec($resource);
    curl_close($resource);
    return json_decode($response);
}

function getDataAPI($urlAPI)
{
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $urlAPI);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl_handle,CURLOPT_TIMEOUT,5);
    $data = curl_exec($curl_handle);
    curl_close($curl_handle);
    if(!empty($data)){
        $data = json_decode($data, true);
        $data = $data['data'];
        return $data;
    }else{
        return '';
    }
}

function getNumberLinkOut($content) {
    preg_match_all('/href="(.*?)"/', $content, $match);
    return count($match[1]);
}

function content_rss_replace($content){
    $content = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $content);
    $content = preg_replace("/\<iframe.*?\>.*?\<\/iframe\>/", "", $content);
    $content = preg_replace("/caption\=['\"].*?['\"]/", "", $content);
    $content = preg_replace("/controls\=['\"].*?['\"]/", "", $content);
    return $content;
}

function init_cms_pagination($page, $pagination){
    $content = '<ul class="pagination">';
    if ($page > 1) $content .= '<li class="page-item">
                                    <a class="page-link" href="' . getUrlPage($page-1) . '">Prev</a>
                                </li>';
    if ($page > 4) $content .= '<li class="page-item">
                                    <a class="page-link" href="' . getUrlPage(1) . '">1</a>
                                </li>
                                <li class="page-item">
                                    <span class="page-link">...</span>
                                </li>';
    for ($i = $page - 3 ; $i <= $page + 3; $i++) {
        if ($i < 1 || $i > $pagination) continue;
        $active = '';
        if ($i == $page) $active = 'active';
        $content .= '<li class="page-item ' . $active . '">
                        <a class="page-link" href="' . getUrlPage($i) . '">' . $i . '</a>
                    </li>';
    }
    if ($page < $pagination - 3) $content .= '<li class="page-item">
                                                <span class="page-link">...</span>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="' . getUrlPage($pagination) . '">' . $pagination . '</a>
                                            </li>';
    $content .= '<li class="page-item">
                    <a class="page-link" href="' . getUrlPage($page+1) . '">Next</a>
                </li>';
    $content .= '</ul>';
    echo $content;
}

function getReward($code)
{
    if ($code == 'mien-bac') {
        $data = [
            'ĐB' => [
                'count' => 1,
                'length' => 5
            ],
            'G1' => [
                'count' => 1,
                'length' => 5
            ],
            'G2' => [
                'count' => 2,
                'length' => 5
            ],
            'G3' => [
                'count' => 6,
                'length' => 5
            ],
            'G4' => [
                'count' => 4,
                'length' => 4
            ],
            'G5' => [
                'count' => 6,
                'length' => 4
            ],
            'G6' => [
                'count' => 3,
                'length' => 3
            ],
            'G7' => [
                'count' => 4,
                'length' => 2
            ],
        ];
    } elseif ($code == 'vietlott') {
        $data = [
            'G3' => [
                'count' => 6,
                'length' => 2
            ],
        ];
    } else {
        $data = [
            'G8' => [
                'count' => 1,
                'length' => 2
            ],
            'G7' => [
                'count' => 1,
                'length' => 3
            ],
            'G6' => [
                'count' => 3,
                'length' => 4
            ],
            'G5' => [
                'count' => 1,
                'length' => 4
            ],
            'G4' => [
                'count' => 7,
                'length' => 5
            ],
            'G3' => [
                'count' => 2,
                'length' => 5
            ],
            'G2' => [
                'count' => 1,
                'length' => 5
            ],
            'G1' => [
                'count' => 1,
                'length' => 5
            ],
            'ĐB' => [
                'count' => 1,
                'length' => 6
            ],
        ];
    }
    return $data;
}

function getProvince($id){
    if ($id == 14)
        $date = date('H') < 17 ? date('Y-m-d') : date('Y-m-d', strtotime("+1 day"));
    else
        $date = date('H') < 18 ? date('Y-m-d') : date('Y-m-d', strtotime("+1 day"));
    $arr_province = [
        '14' => [
            '1' => [
                'Hồ Chí Minh',
                'Đồng Tháp',
                'Cà Mau'
            ],
            '2' => [
                'Bến Tre',
                'Vũng Tàu',
                'Bạc Liêu'
            ],
            '3' => [
                'Đồng Nai',
                'Cần Thơ',
                'Sóc Trăng'
            ],
            '4' => [
                'Tây Ninh',
                'An Giang',
                'Bình Thuận'
            ],
            '5' => [
                'Vĩnh Long',
                'Bình Dương',
                'Trà Vinh'
            ],
            '6' => [
                'Hồ Chí Minh',
                'Long An',
                'Bình Phước',
                'Hậu Giang'
            ],
            '7' => [
                'Tiền Giang',
                'Kiên Giang',
                'Đà Lạt'
            ],
        ],
        '36' => [
            '1' => [
                'TT Huế',
                'Phú Yên'
            ],
            '2' => [
                'Đắk Lắk',
                'Quảng Nam'
            ],
            '3' => [
                'Đà Nẵng',
                'Khánh Hòa',
            ],
            '4' => [
                'Bình Định',
                'Quảng Trị',
                'Quảng Bình'
            ],
            '5' => [
                'Gia Lai',
                'Ninh Thuận'
            ],
            '6' => [
                'Đà Nẵng',
                'Quảng Ngãi',
                'Đắk Nông'
            ],
            '7' => [
                'Khánh Hòa',
                'Kon Tum'
            ],
        ]
    ];
    return $arr_province[$id][date('N', strtotime($date))];
}

function initVideo($url) {
    if (strpos($url, '.m3u8') !== false) {
        $url = '/video.php?url=' . $url;
    }
    $html = "<div>
                    <div class='video position-relative w-100'>
                        <iframe class='w-100 h-100 position-absolute top-0 bottom-0' src='$url' allowfullscreen></iframe>
                    </div>
                </div>";
    return $html;
}

function array_group_by(array $arr, callable $key_selector)
{
    $result = array();
    foreach ($arr as $i) {
        $key = call_user_func($key_selector, $i);
        $result[$key][] = $i;
    }
    return $result;
}

function getBanner($slug){
    $banners = config('app.banner');
    if (empty($banners[$slug])) return;

    if (in_array($slug, ['popunder-pc', 'popunder-mobile', 'dat-cuoc-pc', 'dat-cuoc-mobile', 'link-xem-live-mobile', 'link-xem-live-pc'])){
        return $banners[$slug][0]['link'] ?? '';
    }

    $tmp = '';
    foreach ($banners[$slug] as $index => $item){
        $idBanner = $slug.$index;
        if (IS_AMP){
            $item = '<a rel="'. $item['rel'] .'" target="'. $item['target'] .'" href="'. $item['link'] .'"><amp-img  layout="responsive" src="'. $item['image'] .'" width="' .  $item['width'] . '" height="' .  $item['height'] . '"></amp-img></a>';

            $tmp .= '<div class="ads-container position-relative mw-100" data-position="'.$idBanner.'" id="'.$idBanner.'">
                    <span class="banner-close d-flex font-12 p-0 text-center position-absolute">
                        <i class="info-icon bg-white"></i>
                        <i class="close-icon bg-white" on="tap:'.$idBanner.'.toggleClass(class=\'d-none\'),ampPopup.hide" role="button" tabindex="-1"></i>
                    </span>
                    <div class="banners w-100">'.$item.'</div>
                </div>';
        } else {
            $item = '<a rel="'. $item['rel'] .'" target="'. $item['target'] .'" href="'. $item['link'] .'"><img class="img img-fluid" alt=" '. $item['alt'] .' " src="'. $item['image'] .'" width="' .  $item['width'] . '" height="' .  $item['height'] . '"></a>';
            $tmp .= '<div class="ads-container position-relative mw-100" data-position="'.$idBanner.'" id="'.$idBanner.'">
                    <span class="banner-close d-flex font-12 p-0 text-center position-absolute">
                        <i class="info-icon bg-white"></i>
                        <i class="close-icon bg-white" on="tap:'.$idBanner.'.toggleClass(class=\'d-none\'),ampPopup.hide" role="button" tabindex="-1"></i>
                    </span>
                    <div class="banners">'.$item.'</div>
                </div>';
        }
    }
    return '<div class="banner-wrap" data-position="'.$slug.'">'.$tmp.'</div>';
}

function getBreadcrumb($breadcrumb){
    $br = "<nav aria-label=\"breadcrumb\" class=\"mb-2 border-bottom border-grey\">
                <ol class=\"breadcrumb bg-none p-0\">
                    <li class=\"breadcrumb-item\"><a class=\"text-secondary\" href=\"/\">
                            <span class=\"ml-1\"> Trang chủ</span></a>
                    </li>";

    foreach($breadcrumb as $value){
        if ($value['show']) $br .= "<li class=\"breadcrumb-item\"><a class=\"text-secondary\" href=\"{$value['item']}\">{$value['name']}</a></li>";
    }
    $br .= "    </ol>
            </nav>";
    return $br;
}

function getTylekeo(){
//    id pc: 1;
//    id mobile: 2
    $data = getDataAPI("http://api.sblradar.net/api/v2/page/getTylekeo");
    return $data['content'] ?? '';
}
function getTylekeoMobile()
{
    $data = getDataAPI("http://api.sblradar.net/api/v2/page/getTylekeoMobile");
    return $data['content'] ?? '';

}

function getComputerPredictType($type)
{
    switch($type){
        case 'HOME_ASIA_ID':
            return 1;
            break;
        case 'AWAY_ASIA_ID':
            return 2;
            break;
        case 'EVEN_ODD_MORE_THAN_ID':
            return 1;
            break;
        case 'EVEN_ODD_LESS_THAN_ID':
            return 2;
            break;
        default:
            return -1;
            break;

    }
}

function getDay($time, $type = 0){
    if (strlen($time) > 1)
        $dow = date('N', strtotime($time));
    else
        $dow = $time;

    $arr = [
        0 => ['Thứ Hai','Thứ Ba','Thứ Tư','Thứ Năm','Thứ Sáu','Thứ Bảy','Chủ Nhật'],
        1 => ['t2','t3','t4','t5','t6','t7','cn'],
        2 => ['thu-2','thu-3','thu-4','thu-5','thu-6','thu-7','chu-nhat'],
        3 => ['thứ 2','thứ 3','thứ 4','thứ 5','thứ 6','thứ 7','chủ nhật'],
        4 => ['Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy','Chủ nhật'],
        5 => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    ];
    return $arr[$type][--$dow];
}

function getLichThiDau($date = null) {
    if (!$date) $date = date('Y-m-d');
    $data = \App\Models\LichThiDauIthethao::where('date', $date)->first();
    $content = $data->content ?? "";
    $content = str_replace('colspan="6"', '', $content);
    return $content;
}

function getBannerPc($slug){
    if (IS_MOBILE)
        return false;
    return getBanner($slug);
}
function getBannerMobile($slug){
    if (!IS_MOBILE)
    {if (!IS_AMP)return false;}
    return getBanner($slug);
}
?>
