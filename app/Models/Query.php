<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Query extends Model
{
    use SoftDeletes;
    protected $table = 'queries';
    //public $timestamps = false;

    protected $fillable = [
        'query', 'weight'
    ];
}
