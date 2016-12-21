<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $table = 'cities';
    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'name'
    ];

    public function countries(){
      return $this->belongsTo('App\Models\Country');
    }
    
}
