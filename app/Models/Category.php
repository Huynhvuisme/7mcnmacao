<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Cache;

class Category extends Model

{

    use HasFactory;



    public $timestamps = false;



    public static $_tree = [];



    public function __construct(array $attributes = [])

    {

        parent::__construct($attributes);

        $this->table = 'category';

    }



    static function getTree(){

        self::_getTree();

        return self::$_tree;

    }



    private static function _getTree($parent_id = 0, $prefix_title = ''){

        $listChild = parent::where('parent_id', $parent_id)->get();

        if (!empty($listChild)) foreach ($listChild as $item) {

            self::$_tree[$item->id] = [

                'id' => $item->id,

                'title' => $prefix_title.$item->title,

                'parent_id' => $item->parent_id,

            ];

            self::_getTree($item->id, $prefix_title.'---');

        }

    }
    public static function getBySlug($slug){
        $keyCache = "1category-getBySlug-$slug";
//        $data = Cache::get($keyCache);
        $data = '';
        if (empty($data)){
            $data = self::where('slug', $slug)->first();
            Cache::put($keyCache, $data, 10);
        }
        return $data;
    }

}

