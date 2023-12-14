<?php

namespace App\Http\Controllers\web;

use App\Models\Post;
use Carbon\Carbon;
use App\Models\Nha_Cai;
use App\Http\Controllers\WebController;

class HomeController extends WebController
{
    const LIMIT_TOP_POST = 5;
    public function index() {
        $now = Carbon::now();
        $subTwoHour = $now->copy()->subHour(2);
        $top_post_homepage = Post::where('status', 1)
                                        ->select('post.*',
                                                'featured_post.post_id',
                                                'featured_post.order',
                                                'match.id_bongdalu',
                                                'match.scheduled',
                                                )
                                        ->join('featured_post', 'featured_post.post_id', '=' , 'post.id')
                                        ->join('match', function($query){
                                            $query->on('post.id_bongdalu', '=', 'match.id_bongdalu')
                                                ->orOn('post.id_match', '=', 'match.id');
                                        })
                                        ->where('displayed_time', '<=', $now)
                                        ->where('scheduled', '>=', $subTwoHour)
                                        ->limit(self::LIMIT_TOP_POST)
                                        ->orderBy('featured_post.order')
                                        ->orderBy('match.scheduled')
                                        ->get();
        $posts = Post::where('status', 1)
            ->select('post.*')
            ->join('match', function($query){
                $query->on('post.id_bongdalu', '=', 'match.id_bongdalu')
                    ->orOn('post.id_match', '=', 'match.id');
            })
            ->where('displayed_time', '<=', $now)
            ->where('scheduled', '<=', $now)
            ->whereNotNull('id_match')
            ->limit(25)
            ->orderBy('match.scheduled', 'DESC')
            ->get();
        $data['posts'] = $top_post_homepage->merge($posts);
        $data['listNhaCai'] = Nha_Cai::where('type', 1)->orderBy(Nha_Cai::raw('order_by = 0'))->orderBy('order_by')->get();

        $data['isHomePage'] = true;

        $data['soikeo_today'] = Post::get_list_match(['limit' => -1]);

        $data['seo_data'] = initSeoData();

        // $url7M = IS_MOBILE ? "https://www.bongdalu5.com/?from=pc" : "https://www.bongdalu4.com/free/freesoccerodds"; //tiếng việt
        $url7M = "https://free.nowgoal.plus/free/freesoccer"; //tiếng anh
        $data['url7M'] = $url7M;
        $data['home_page'] = true;
        return view('web.home.index', $data);
    }
}
