<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    const LIST_KEO = [ // category id => crawler url
        2 => 'ngoai-hang-anh',
        3 => 'la-liga',
        4 => 'v-league',
        5 => 'ligue-1', 
        6 => 'bundesliga', 
        7 => 'serie-a',
        9 => 'cup-c1-chau-au', 
        10 => 'cup-c2-chau-au',
        11 => 'uefa-europa-conference-league',
        14 => 'world-cup',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'post';
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }
    
    public function match(){
        // return $this->hasOne(Match::class, 'id_bongdalu', 'id_bongdalu');
    }
    
    static function getPosts($params) {
        extract($params);
        $data = self::where([
            'status' => 1,
            ['displayed_time', '<=', Post::raw('NOW()')]
        ]);

        if (isset($category_id)) {
            $data = $data->join('post_category', 'post_category.post_id', '=', 'post.id');
            $data = $data->where('post_category.category_id', $category_id);
            if (!empty($only_primary_category)) {
                $data = $data->where('post_category.is_primary', 1);
            }
        }

        if (isset($info_category)) {
            $data = $data->with('category');
        }

        $offset = $offset ?? 0;
        $limit = $limit ?? 10;

        $data = $data->orderBy('post.displayed_time', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();
        return $data;
    }

    static function getCount($params) {
        extract($params);
        $data = self::where([
            'status' => 1,
            ['displayed_time', '<=', Post::raw('NOW()')]
        ]);

        if (isset($category_id)) {
            $data = $data->join('post_category', 'post_category.post_id', '=', 'post.id');
            $data = $data->where('post_category.category_id', $category_id);
            if (!empty($only_primary_category)) {
                $data = $data->where('post_category.is_primary', 1);
            }
        }

        return $data->count();
    }

    static function get_list_match($params){
        extract($params);
        $offset = $offset ?? 0;
        $limit = $limit ?? 10;
        $order_by = $order_by ?? ['match.scheduled' => 'ASC'];
        $res = self::select('post.*', 'scheduled', 'tournament', 'team_home_name', 'team_home_logo', 'team_away_name', 'team_away_logo', 'hdc_asia', 'hdc_eu', 'hdc_tx')
            ->join('match', 'post.id_bongdalu', '=', 'match.id_bongdalu');
        if (!empty($category_id)) {
            $res = $res->where('category_id', $category_id);
        }
        if(!empty($category_ids))
        {
            $res->with('categories')->whereHas('categories', function ($query) use ($category_ids){
                                        $query->whereIn('id', $category_ids);
                                    });
        }
        $res = $res->where('status', 1);
        $res = $res->where('displayed_time', '<=', Post::raw('NOW()'));
        if (!empty($scheduled_after)) {
            $res = $res->where('match.scheduled', '>=', $scheduled_after);
        } elseif (!empty($scheduled_before)) {
            $res = $res->where('match.scheduled', '<=', $scheduled_before);
        } else {
            $res = $res->where('match.scheduled', '>', Post::raw('(NOW() - INTERVAL 2 HOUR)'));
        }
        if (!empty($not_in)) foreach ($not_in as $key => $value) {
            $res = $res->whereNotIn($key, $value);
        }
        foreach ($order_by as $key => $value) {
            $res = $res->orderBy($key, $value);
        }
        if(isset($computerPredict))
        {
            $res = $res->addSelect('computer_predict.asia_predict', 'computer_predict.even_odd_predict', 'computer_predict.home_score', 'computer_predict.away_score')
                        ->leftJoin('computer_predict', 'match.id', '=', 'computer_predict.match_id');
        }
        $res = $res->limit($limit, $offset);
        $res = $res->get();
        return $res;
    }

    public function featuredPost()
    {
        return $this->hasOne(FeaturedPost::class, 'post_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

