<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Product extends Model
{
    use SoftDeletes;
    use Eloquence;
    protected $searchableColumns = ['name'];

    protected $table = 'products';
    // public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
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
                  ->withPivot('price', 'url', 'amount')
                  ->orderBy('price','asc');
    }

    public function feedbacks(){
      return $this->hasMany('App\Models\Product\Feedback', 'product_id', 'id');
    }

    public function values(){
      return $this->belongsToMany('App\Models\Value', 'products_values', 'product_id', 'value_id');
    }
}
