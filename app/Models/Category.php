<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'name', 'slack'
    ];

    public function products(){
      return $this->belongsToMany('App\Models\Product', 'categories_products', 'category_id', 'product_id');
    }

    public function subcategory(){
      return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }
}
