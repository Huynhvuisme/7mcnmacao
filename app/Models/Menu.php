<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'menu';
    }

    public function findByName($name){
        return $this->query()
                    ->where('name')
                    ->first();
    }
}
