<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    protected $table = 'properties';
    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'name'
    ];
    public function values(){
      return $this->hasMany('App\Models\Value', 'property_id', 'id');
    }
    public function subproperty(){
      return $this->hasMany('App\Models\Property', 'parent_id', 'id');
    }
}
