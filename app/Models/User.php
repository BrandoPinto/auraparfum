<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $cellphone
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $idRole
 * @property int $dni
 * @property Carbon|null $registraton_date
 * @property int $state
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    // Corrección en $casts y eliminación de campos no necesarios
    protected $casts = [
        'cellphone' => 'int',
        'email_verified_at' => 'datetime',
        'idRole' => 'int',
        'dni' => 'int',
        'registraton_date' => 'datetime',
        'state' => 'int',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'cellphone',
        'email_verified_at',
        'password',
        'remember_token',
        'idRole',
        'dni',
        'registraton_date',
        'state', // Asegúrate de incluir todos los campos necesarios
    ];
}
