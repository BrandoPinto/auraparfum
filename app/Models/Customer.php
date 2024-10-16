<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $customers_id
 * @property string $name
 * @property int $cellphone
 * @property int|null $dni
 * @property string|null $email
 * @property int $idUser
 * @property int $state
 * @property Carbon $registration_date
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customers';
	protected $primaryKey = 'customers_id';
	public $timestamps = false;

	protected $casts = [
		'cellphone' => 'int',
		'dni' => 'int',
		'idUser' => 'int',
		'state' => 'int',
		'registration_date' => 'datetime'
	];

	protected $fillable = [
		'name',
		'cellphone',
		'dni',
		'email',
		'idUser',
		'state',
		'registration_date'
	];
}
