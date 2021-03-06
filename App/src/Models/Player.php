<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:38
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'player';

    protected $primaryKey = 'player_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'country_id'
    ];
}