<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;
    protected $table = 'information';
    public $timestamps = false;

    protected $fillable = ['shop_id', 'description'];

    public function shop(){
      return $this->belongsTo('App\Models\Shop', 'id');
    }
}
