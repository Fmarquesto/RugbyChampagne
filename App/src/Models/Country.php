<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 21:23
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    protected $primaryKey = 'country_id';
}