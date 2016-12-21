<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    protected $table = 'countries';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function cities(){
      return $this->hasMany('App\Models\City', 'country_id', 'id');
    }
}
