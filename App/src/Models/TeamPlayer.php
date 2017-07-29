<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:37
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    protected $table = 'team_player';

    protected $primaryKey = 'team_player_id';

    protected $fillable = [
        'team_id',
        'player_id',
        'active'
    ];
}