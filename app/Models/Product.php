<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function categories(){
      return $this->belongsToMany('App\Models\Category', 'categories_products', 'product_id', 'category_id');
    }

    public function images(){
      return $this->belongsToMany('App\Models\Image', 'products_images', 'product_id', 'image_id');
    }

    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop', 'shop_products', 'product_id', 'shop_id')
                    ->withPivot('price', 'url', 'amount');
    }

    public function feedbacks(){
      return $this->hasMany('App\Models\Product\Feedback', 'product_id', 'id');
    }
}
