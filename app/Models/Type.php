<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 Nov 2017 17:33:53 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Type
 * 
 * @property int $id
 * @property string $libelle
 * @property int $userId
 * 
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $oeuvres
 *
 * @package App\Models
 */
class Type extends Eloquent
{
	protected $table = 'type';
	public $timestamps = false;

	protected $casts = [
		'userId' => 'int'
	];

	protected $fillable = [
		'libelle',
		'userId'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'userId');
	}

	public function oeuvres()
	{
		return $this->hasMany(\App\Models\Oeuvre::class, 'typeId');
	}
}
