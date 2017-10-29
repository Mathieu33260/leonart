<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 29 Oct 2017 15:00:58 +0000.
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
 * 
 * @property \Illuminate\Database\Eloquent\Collection $oeuvres
 *
 * @package App\Models
 */
class Artiste extends Eloquent
{
	protected $table = 'artiste';
	public $timestamps = false;

	protected $dates = [
		'dateN',
		'dateM'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'dateN',
		'dateM'
	];

	public function oeuvres()
	{
		return $this->hasMany(\App\Models\Oeuvre::class, 'artisteId');
	}
}
