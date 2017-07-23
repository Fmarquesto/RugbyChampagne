<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 11/7/2017
 * Time: 19:33
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    protected $table ='championship';

    protected $primaryKey = 'championship_id';

    protected $fillable = [
        'name',
        'win_points',
        'draw_points',
        'lose_points',
        'round',
        'category_id'
    ];
}