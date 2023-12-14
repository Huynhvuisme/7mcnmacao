<?php

namespace App\Http\Controllers\web;

use App\Models\Crawler;
use App\Models\Match;
use App\Models\Da_ga;
use Carbon\Carbon;
use App\Http\Controllers\WebController;
use App\Models\LichThiDauIthethao;
use Illuminate\Support\Facades\Log;

require (__DIR__.'/../../../../public/web/libraries/Sunra/PhpSimple/HtmlDomParser.php');

class CrawlerController extends WebController
{
    const URL_BONGDALU = "https://www.bongdalu4.com";
    const LIST_KEO = [
        'ngoai-hang-anh',
        'la-liga',
        'v-league',
        'ligue-1',
        'bundesliga',
        'serie-a',
        'cup-c1-chau-au',
        'cup-c2-chau-au',
        'uefa-europa-conference-league',
        'world-cup',
    ];

    public function index($slug) {
        $this->$slug();
    }

    function get_html($url_crawl){
        $crawl = new \Sunra\PhpSimple\HtmlDomParser();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$url_crawl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $dom = curl_exec($curl_handle);
        curl_close($curl_handle);
        if(!empty($dom)){
            $dom = $crawl->str_get_html($dom);
            return $dom;
        }else{
            return '';
        }
    }

//    public function du_doan_bong_da(){
//        $crawl = new \Sunra\PhpSimple\HtmlDomParser();
//        $url = 'http://bongda.wap.vn/du-doan-bong-da-cua-bao-chi.html';
//        $page = "may-tinh-du-doan-bong-da";
//        $dom = $this->get_html($url);
//        $_tr = $dom->find('div.baochi', 0)->outertext();
//        $content = trim($_tr);
//        $data = [];
//        Crawler::updateOrInsert(['page' => $page], $data);
//    }

    // public function crawl_match_info()
    // {
    //     //get post match pending
    //     $match_pending = Match::where('crawl_status', 'pending')->get();

    //     if(date('H') == '04') (new \App\Models\Match)->update_match_done_crawl();

    //     if($match_pending->count()){
    //         foreach ($match_pending as $key => $match){
    //             //if ($key < $offset || $key > ($offset + $limit)) continue;
    //             try{
    //                 $id_bdl = $match->id_bongdalu;
    //                 $url_crawl = self::URL_BONGDALU.'/match/live-'.$id_bdl;
    //                 #
    //                 $dom = $this->get_html($url_crawl);
    //                 //$dom = $crawl->file_get_html($url_crawl);
    //                 if(!empty($dom) && $dom->find('div[class=home]')){
    //                     $time = $dom->find('span[name=timeData] script', 0)->innertext();
    //                     preg_match('/(.*?)\'(.*?)\'(.*?)/', $time, $time);
    //                     $time = $time[2];
    //                     $time = explode(' ', $time);
    //                     $m_scheduled = date('Y-m-d', strtotime($time[0])).' '.date('H:i:s', strtotime($time[1].$time[2]));
    //                     $m_scheduled =  date('Y-m-d H:i:s', strtotime($m_scheduled) + 60*60*7);
    //                     $tournament = $dom->find('.LName',0)->plaintext;
    //                     //$tournament = $dom->find('.LName',0)->first_child()->text();
    //                     if ($dom->find('div[class=home]')) {
    //                         $logo_home = $dom->find('div[class=home]',0)->first_child()->src;
    //                         /*$arr_logo_home = explode('/', $logo_home);
    //                         if (file_exists('/home/soikeo247.com/public_html/media/thumb_soikeo/'.end($arr_logo_home))) {
    //                             $logo_home = '/media/thumb_soikeo/'.end($arr_logo_home);
    //                         }*/
    //                     }
    //                     if ($dom->find('div[class=guest]')) {
    //                         $logo_away = $dom->find('div[class=guest]',0)->first_child()->src;
    //                         /*$arr_logo_away = explode('/', $logo_away);
    //                         if (file_exists('/home/soikeo247.com/public_html/media/thumb_soikeo/'.end($arr_logo_away))) {
    //                             $logo_away = '/media/thumb_soikeo/'.end($arr_logo_away);
    //                         }*/
    //                     }
    //                     if ($dom->find('div[id=headVs]')) $home_name = $dom->find('div[id=headVs]',0)->first_child()->first_child()->first_child()->first_child()->first_child()->text();
    //                     if ($dom->find('div[id=headVs]')) $away_name = $dom->find('div[id=headVs]',0)->first_child()->first_child()->last_child()->first_child()->first_child()->text();

    //                     //if(!empty($logo_home)) $logo_home = !empty($match->m_team_home_logo) ? $match->m_team_home_logo : $this->getImageFromUrl($logo_home, $directory);
    //                     //if(!empty($logo_away)) $logo_away = !empty($match->m_team_away_logo) ? $match->m_team_away_logo : $this->getImageFromUrl($logo_away, $directory);

    //                     $match_info_team = array();
    //                     if (!empty(trim($tournament))) $match_info_team['tournament'] = trim(html_entity_decode($tournament));
    //                     if (!empty(trim($home_name))) $match_info_team['team_home_name'] = trim(html_entity_decode($home_name));
    //                     if (!empty(trim($logo_home)))$match_info_team['team_home_logo'] = $this->saveImageBongdalu(trim($logo_home));
    //                     if (!empty(trim($away_name))) $match_info_team['team_away_name'] = trim(html_entity_decode($away_name));
    //                     if (!empty(trim($logo_away)))$match_info_team['team_away_logo'] = $this->saveImageBongdalu(trim($logo_away));
    //                     if (!empty($m_scheduled)) $match_info_team['scheduled'] = $m_scheduled;

    //                     $match_info_team = array_filter($match_info_team);
    //                     if(count($match_info_team) > 1) Match::updateOrInsert(['id_bongdalu' => $id_bdl], $match_info_team);
    //                     #
    //                     $bet_data = $this->get_html(self::URL_BONGDALU.'/ajax/soccerajax?type=1&id='.$id_bdl);
    //                     //$bet_data = file_get_contents('http://www.bongdalu.com/Ajax.aspx?type=23&ID='.$id_bdl);
    //                     if(!empty($bet_data)){
    //                         $bet_data = $this->convert_bet_data($bet_data);
    //                         if (empty($bet_data['data'])) continue;
    //                         $hdc_eu = $bet_data['data'][0].'/'.$bet_data['data'][1].'/'.$bet_data['data'][2];
    //                         $hdc_asia = $bet_data['data'][7].'*'.$bet_data['data'][8].'*'.$bet_data['data'][9];
    //                         //$hdc_asia = $bet_data['data'][3].'*'.$bet_data['data'][4].'*'.$bet_data['data'][5];
    //                         $hdc_tx = $bet_data['data'][11].'*'.$bet_data['data'][12].'*'.$bet_data['data'][13];
    //                         #
    //                         if($hdc_eu!='//' && $hdc_asia!='**' && $hdc_tx!='**'){
    //                             if(count($match_info_team) == 6)
    //                                 $crawl_status = 'done';
    //                             else
    //                                 $crawl_status = 'pending';
    //                             $match_info = array(
    //                                 'hdc_asia' => trim($hdc_asia),
    //                                 'hdc_eu' => trim($hdc_eu),
    //                                 'hdc_tx' => trim($hdc_tx),
    //                                 'crawl_status' => $crawl_status
    //                             );
    //                             Match::updateOrInsert(['id_bongdalu' => $id_bdl], $match_info);
    //                         }
    //                     }
    //                 }
    //             }catch(\Exception $e){
    //                 Log::alert($e->getMessage());
    //                 //$match_info = array('crawl_status' => 'error');
    //                 //$this->MatchModel->update($id_bdl,$match_info);
    //             }
    //         }
    //         //$this->MatchModel->reset_match_pending_crawl();
    //     }
    // }

    // public function crawl_match_info_live()
    // {
    //     $match_pending = Match::where([['scheduled', '>=', Match::raw('NOW() - INTERVAL 3 HOUR')], ['scheduled', '<=', Match::raw('NOW() + INTERVAL 3 DAY')]])->get();

    //     if($match_pending->count()){
    //         foreach ($match_pending as $key => $match){
    //             try{
    //                 $id_bdl = $match->id_bongdalu;
    //                 #
    //                 $bet_data = $this->get_html(self::URL_BONGDALU.'/ajax/soccerajax?type=1&id='.$id_bdl);
    //                 if(!empty($bet_data)){
    //                     $bet_data = $this->convert_bet_data($bet_data);
    //                     if (empty($bet_data['live'])) continue;
    //                     $hdc_eu = $bet_data['live'][0].'/'.$bet_data['live'][1].'/'.$bet_data['live'][2];
    //                     $hdc_asia = $bet_data['live'][7].'*'.$bet_data['live'][8].'*'.$bet_data['live'][9];
    //                     $hdc_tx = $bet_data['live'][11].'*'.$bet_data['live'][12].'*'.$bet_data['live'][13];
    //                     #
    //                     if($hdc_eu!='//' && $hdc_asia!='**' && $hdc_tx!='**'){
    //                         $match_info = array(
    //                             'hdc_asia' => trim($hdc_asia),
    //                             'hdc_eu' => trim($hdc_eu),
    //                             'hdc_tx' => trim($hdc_tx),
    //                         );
    //                         Match::where(['id_bongdalu' => $id_bdl])->update($match_info);
    //                     }
    //                 }
    //             }catch(\Exception $e){
    //             }
    //         }
    //     }
    // }

    protected function saveImageBongdalu($url)
    {
        $image_url = '/web/images/flags/'.str_replace('//football.bongdalu4.com/image/team/images/', '', $url);
        $url_path = public_path().$image_url;
        if(!file_exists($url_path) || !getimagesize($url_path)){
            try{
                file_put_contents($url_path, file_get_contents('https:'.$url));
                if(!getimagesize($url_path)){
                    $image_url = $url;
                }
            } catch(\Exception $e){
                $image_url = $url;
                Log::warning($e->getMessage());
            }
        }
        return $image_url;
    }

    function convert_bet_data($str_bet_data){
        $bet_data_ar = explode(';',$str_bet_data);
        $bet_data = array();
        for($i=0;$i<count($bet_data_ar);++$i){
            if($bet_data_ar[$i] == 'Crown' || $bet_data_ar[$i] == 'Crow*'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }elseif($bet_data_ar[$i] == 'Bet365'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }elseif($bet_data_ar[$i] == '10BET'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }
        }
        $bet_data = $this->parse_betdata( $bet_data );
        return $bet_data;
    }

    function parse_betdata($bet) {
        $run = [11, 13];
        //$run = [7, 9, 11, 13];
        foreach ($run as $i) {
            if (!isset($bet['live'][$i])) continue;

            $data = (float) $bet['live'][$i];

            if ($data > 1) {
                $data = $data - 2;
            }

            $data = number_format($data, 2);
            $bet['live'][$i] = $data;
        }

        foreach ($run as $j) {
            if (!isset($bet['data'][$j])) continue;

            $data = (float) $bet['data'][$j];

            if ($data > 1) {
                $data = $data - 2;
            }

            $data = number_format($data, 2);
            $bet['data'][$j] = $data;
        }

        return $bet;
    }

    public function da_ga()
    {
        $crawl = new \Sunra\PhpSimple\HtmlDomParser();
        $mainUrl = 'https://dagacuasat2.com/video-da-ga/da-ga-campuchia';
        $mainSite = $this->get_html($mainUrl);
        $categoryLink = $mainSite->find('.jnews_category_hero_container .jeg_thumb a');
        $postLink = $mainSite->find('.jeg_main_content .jeg_postblock_content .jeg_post_title a');
        $links = array_merge($categoryLink, $postLink);

        $data = array();
        $now = Carbon::now();

        foreach($links as $key => $link)
        {
            $url = $link->attr['href'] ?? '';

            if($this->daGaExist($url))
            {
                continue;
            }
            $data[$key]['slug'] = str_replace('.html', '', str_replace('https://dagacuasat2.com/', '', $url));
            $data[$key]['origin_url'] = $url;
            $article = $this->get_html($url);
            $data[$key]['title'] = $article->find('.jeg_main_content .jeg_inner_content .entry-header h1', 0)->innertext;
            $data[$key]['description'] = $article->find('meta [property="og:description"]', 1)->attr['content'] ?? $article->find('meta [property="og:description"]', 0)->attr['content'];
            $data[$key]['thumbnail'] = $article->find('.jeg_main_content .thumbnail-container img', 0)->attr['data-src'] ?? '';
            $data[$key]['status'] = 0;
            $data[$key]['displayed_time'] = $now;
            $content = $article->find('.jeg_main_content .jeg_inner_content .entry-content', 0);
            $comment = $content->find('.jnews_comment_container', 0) ?? '';
            $prevNext = $content->find('.jnews_prev_next_container', 0) ?? '';
            $popup = $content->find('.jnews_popup_post_container', 0) ?? '';
            $saboxplugin = $content->find('.saboxplugin-wrap', 0) ?? '';
            $tag = $content->find('.jeg_post_tags', 0) ?? '';
            $data[$key]['content'] = str_replace([ $comment, $popup, $prevNext, $saboxplugin, $tag], '', $content);
        }
        Da_ga::insert($data);
        return 0;
    }

    public function daGaExist($url)
    {
        $daGa = Da_ga::where('origin_url', $url)->first();
        return isset($daGa) ? 1 : 0;
    }

    public function ty_le_keo(){
        $url = 'https://bongdanet.mobi/keo-bong-da/';
        $listPartUrl = self::LIST_KEO;
        $a = [];
        foreach($listPartUrl as $urlPart)
        {
            $urlPage = $url.$urlPart;
            $dom = self::get_html($urlPage);
            if(empty($dom)){
                continue;
            }
            $a[] = $urlPage;
            $crawlTable = $dom->find('#zone-league-by-season-round', 0);
            if(empty($crawlTable))
            {
                continue;
            }
            Crawler::updateOrInsert(['page' => $urlPart], ['content' => $crawlTable, 'page' => $urlPart, 'url' => $urlPage]);
        }
    }

    public function crawl_total_corner()
    {
        $url = "https://www.totalcorner.com/match/today";
        $page = "soi-keo-phat-goc-c16";
        $dom = self::get_html($url);
        $rows = $dom->find('.tbody_match tr');
        $html = "";
        $html .= "<tbody>";
        foreach ($rows as $row)
        {
            $cols = $row->find('td');
            $html .= "<tr>";
            if($cols)
            {
                $colTime = $cols[2]->innertext();
                $time = Carbon::parse($colTime)->addHours(6)->format("H:i");
                $html.= $cols[1]; // col td_league
                $html.= "<td class='match_time'>".$time."</td>"; // col time
                $html.= $cols[3]; // col match status
                $html.= $cols[4]; // col match home
                $html.= $cols[8]; // col match score
                $html.= $cols[6]; // col match away
            }
            $html.= "</tr>";
        }
        $html .= "</tbody>";
        $html = preg_replace('#<a.*?>(.*?)</a>#i', '$1', $html);
        $html = preg_replace('#<span class="minutes_postfix.*?</span>#i', "<img src='/web/images/in2.gif' width='3' height='8'>", $html);

        $data = array(
            'page' => $page,
            'url' => $url,
            'content' => $html,
        );
        $crawl = Crawler::where('page', $page)->first();
        if($crawl)
        {
            Crawler::where('page', $page)->update($data);
        }else{
            Crawler::insert($data);
        }
    }

    public function du_doan_bong_da(){
        $urlPage = 'https://ketquabongda.com/du-doan-bong-da.html';
        $dom = self::get_html($urlPage);
        if(empty($dom)) dd(1);
        $content = $dom->find('.layout_content table', 0)->outertext();
        $content = str_replace('<th>BĐ</th>', '<th>Máy tính 1</th>', $content);
        $content = str_replace('<th>TT247</th>', '<th>Máy tính 2</th>', $content);
        $content = str_replace('<th>QLE.vn</th>', '<th>Máy tính 3</th>', $content);
        $content = str_replace('<th class="kq">KQ</th>', '<th class="kq">Kết quả</th>', $content);
        $content = preg_replace('/<tr class="ads_mobile">(.*?)<\/tr>/', '', $content);
        if (strlen($content) < 300) dd('empty');
        Crawler::updateOrInsert(['page' => 'du-doan-bong-da'], ['content' => $content, 'url' => $urlPage]);
    }

    public function lich_thi_dau_ithethao(){
        for ($i = 0; $i < 7; $i++) {
            $date = date('d-m-Y', strtotime('+'.$i.' day'));
            $urlPage = 'https://ithethao.vn/football-data/widget-calendar-ajax.html?date='.$date;
            $dom = self::get_html($urlPage);
            if (empty($dom)) dd(1);
            $content = $dom->find('.list-schedule-all', 0)->innertext();
            $content = preg_replace('/<img(.*?)>/', '', $content);
            $content = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $content);
            $content = str_replace('pb-5 pt-0', 'p-3', $content);
            $content = str_replace('style="display: table-caption;"', '', $content);
            $content = str_replace('mr-10', 'mr-2', $content);
            $content = str_replace('mr-5', 'mr-1', $content);
            LichThiDauIthethao::updateOrInsert(['date' => date('Y-m-d', strtotime($date))], ['content' => $content]);
        }
    }

    public function may_tinh_du_doan() {
        $urlPage = 'https://bongdapro.vn/may-tin-du-doan-bong-da';
        $dom = $this->get_html($urlPage);
        $content = $dom->find('.body-content-du-doan', 0)->innertext();
        // $content = preg_replace('/<img(.*?)>/', '', $content);
        $content = str_replace('/img/default-logo.svg', '/images/default-logo.png/', $content);
        $saveData = Crawler::updateOrInsert(['page' => 'may-tinh-du-doan-bong-da'], ['content' => $content], ['url' => $urlPage]);
        if ($saveData) {
            return response()->json([
                "status" => 200,
                "message" => "Lưu thành công",
            ]);
        }
        return response()->json([
            "status" => 400,
            "message" => "Lưu thất bại",
        ]);
    }
}
