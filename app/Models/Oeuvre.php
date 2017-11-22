<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 Nov 2017 17:33:53 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Oeuvre
 * 
 * @property int $id
 * @property string $nom
 * @property string $modele
 * @property int $idIbeacon
 * @property float $posX
 * @property float $posY
 * @property string $audio
 * @property int $typeId
 * @property int $artisteId
 * @property int $userId
 * 
 * @property \App\Models\Artiste $artiste
 * @property \App\Models\Type $type
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Oeuvre extends Eloquent
{
	protected $table = 'oeuvre';
	public $timestamps = false;

	protected $casts = [
		'idIbeacon' => 'int',
		'posX' => 'float',
		'posY' => 'float',
		'typeId' => 'int',
		'artisteId' => 'int',
		'userId' => 'int'
	];

	protected $fillable = [
		'nom',
		'modele',
		'idIbeacon',
		'posX',
		'posY',
		'audio',
		'typeId',
		'artisteId',
		'userId'
	];

	public function artiste()
	{
		return $this->belongsTo(\App\Models\Artiste::class, 'artisteId');
	}

	public function type()
	{
		return $this->belongsTo(\App\Models\Type::class, 'typeId');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'userId');
	}
}
