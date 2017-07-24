<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:37
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='category';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name'
    ];
}