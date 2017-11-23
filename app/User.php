<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $visiteur
 *
 * @property \Illuminate\Database\Eloquent\Collection $artistes
 * @property \Illuminate\Database\Eloquent\Collection $oeuvres
 * @property \Illuminate\Database\Eloquent\Collection $types
 *
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $casts = [
        'visiteur' => 'bool'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'visiteur'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function artistes()
    {
        return $this->hasMany(\App\Models\Artiste::class, 'userId');
    }

    public function oeuvres()
    {
        return $this->hasMany(\App\Models\Oeuvre::class, 'userId');
    }

    public function types()
    {
        return $this->hasMany(\App\Models\Type::class, 'userId');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
}
