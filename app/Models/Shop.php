<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;
    protected $table = 'shops';
    public $timestamps = false;

    protected $fillable = [
        'name', 'url', 'image_id'
    ];

    public function information(){
      return $this->hasMany('App\Models\Shop\Information');
    }

    public function image(){
      return $this->hasOne('App\Models\Image', 'id', 'image_id');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'shop_products', 'shop_id', 'product_id')
                    ->withPivot('price', 'url', 'amount');
    }

}
