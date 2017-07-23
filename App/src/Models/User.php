<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 8/7/2017
 * Time: 14:13
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table ='user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'password',
        'name',
        'last_name'
    ];
}