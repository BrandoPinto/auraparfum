<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $idservices
 * @property string $service
 * @property int $idUser
 * @property int $idtypeofpayment
 * 
 * @property Typeofpayment $typeofpayment
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'services';
	protected $primaryKey = 'idservices';
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int',
		'idtypeofpayment' => 'int'
	];

	protected $fillable = [
		'service',
		'idUser',
		'idtypeofpayment'
	];

	public function typeofpayment()
	{
		return $this->belongsTo(Typeofpayment::class, 'idtypeofpayment');
	}
}
