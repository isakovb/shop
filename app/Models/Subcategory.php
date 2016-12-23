<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Subcategory extends Model
{
    use SoftDeletes;
    use Eloquence;
    protected $searchableColumns = ['name'];

    protected $table = 'categories';


    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function products(){
      return $this->belongsToMany('App\Models\Product', 'categories_products', 'category_id', 'product_id');
    }

    public function category(){
      return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }
}
