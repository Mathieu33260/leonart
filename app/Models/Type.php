<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Oct 2017 09:07:54 +0000.
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
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'libelle'
	];

	public function oeuvres()
	{
		return $this->hasMany(\App\Models\Oeuvre::class, 'typeId');
	}
}
