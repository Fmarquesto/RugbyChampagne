<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:37
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table ='team';

    protected $primaryKey = 'team_id';

    protected $fillable = [
        'name',
        'category_id',
        'country_id'
    ];
}