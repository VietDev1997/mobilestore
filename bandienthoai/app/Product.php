<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function config(){
        return $this->hasOne('App\Configuration');
    }

    public function image(){
        return $this->hasMany('App\Image');
    }
}
