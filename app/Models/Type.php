<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 29 Oct 2017 15:00:58 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Type
 * 
 * @property int $id
 * @property string $libelle
 * 
 * @property \Illuminate\Database\Eloquent\Collection $oeuvres
 *
 * @package App\Models
 */
class Type extends Eloquent
{
	protected $table = 'type';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];

	public function oeuvres()
	{
		return $this->hasMany(\App\Models\Oeuvre::class, 'typeId');
	}
}
