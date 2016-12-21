<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $table = 'images';
    public $timestamps = false;

    protected $fillable = [
        'url'
    ];

    public function products(){
      return $this->belongsToMany('App\Models\Product', 'products_images', 'image_id', 'product_id');
    }

    public function shop(){
  		return $this->belongsTo('App\Models\Shop');
  	}
}
