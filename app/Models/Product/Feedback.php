<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;
    protected $table = 'feedback';
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'message', 'user_id', 'url', 'rating'
    ];

    public function products(){
      return $this->belongsTo('App\Models\Product');
    }
}
