<?php

/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 20/10/2017
 * Time: 14:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class Type extends Model
{
    public $fillable = ['id', 'libelle'];
}