<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Typeofpayment
 * 
 * @property int $idtypeofpayment
 * @property string $type
 * 
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Typeofpayment extends Model
{
	protected $table = 'typeofpayment';
	protected $primaryKey = 'idtypeofpayment';
	public $timestamps = false;

	protected $fillable = [
		'type'
	];

	public function services()
	{
		return $this->hasMany(Service::class, 'idtypeofpayment');
	}
}
