<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Category extends Model
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
    // public function subcategories()
    // {
    //     return $this->belongsTo(self::class, 'parent_id', 'id');
    // }
    // public function parent()
    // {
    //     return $this->hasMany(self::class, 'id', 'parent_id');
    // }
    public function subcategories(){
      return $this->hasMany('App\Models\Subcategory', 'parent_id', 'id');
    }
}
