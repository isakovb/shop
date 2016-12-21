<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Value extends Model
{
    use SoftDeletes;
    protected $table = 'values';
    public $timestamps = false;

    protected $fillable = [
      'name', 'property_id'
    ];

    public function properties(){
      return $this->belongsTo('App\Models\Property', 'property_id', 'id');
    }
}
