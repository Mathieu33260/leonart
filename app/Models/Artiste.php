<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 Nov 2017 17:33:53 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Artiste
 * 
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property \Carbon\Carbon $dateN
 * @property \Carbon\Carbon $dateM
 * @property int $userId
 * 
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $oeuvres
 *
 * @package App\Models
 */
class Artiste extends Eloquent
{
	protected $table = 'artiste';
	public $timestamps = false;

	protected $casts = [
		'userId' => 'int'
	];

	protected $dates = [
		'dateN',
		'dateM'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'dateN',
		'dateM',
		'userId'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'userId');
	}

	public function oeuvres()
	{
		return $this->hasMany(\App\Models\Oeuvre::class, 'artisteId');
	}
}
