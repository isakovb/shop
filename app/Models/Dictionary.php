<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Dictionary extends Model
{
    use SoftDeletes;
    use Eloquence;
    protected $searchableColumns = ['name'];

    protected $table = 'dictionaries';


    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

}
