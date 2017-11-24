<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 24 Nov 2017 13:12:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class VisitedOeuvre
 * 
 * @property int $oeuvreId
 * @property int $userId
 * 
 * @property \App\Models\Oeuvre $oeuvre
 * @property \App\User $user
 *
 * @package App\Models
 */
class VisitedOeuvre extends Eloquent
{
	protected $table = 'visited_oeuvre';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'oeuvreId' => 'int',
		'userId' => 'int'
	];

	public function oeuvre()
	{
		return $this->belongsTo(\App\Models\Oeuvre::class, 'oeuvreId');
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'userId');
	}
}
