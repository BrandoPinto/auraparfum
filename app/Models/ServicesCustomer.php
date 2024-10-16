<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServicesCustomer
 * 
 * @property int $idservices_customers
 * @property int $idservices
 * @property int $idcustomers
 * @property float $amount
 * @property Carbon $date
 * @property Carbon $expiration_date
 * @property int $state
 * 
 * @property Customer $customer
 * @property Service $service
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class ServicesCustomer extends Model
{
	protected $table = 'services_customers';
	protected $primaryKey = 'idservices_customers';
	public $timestamps = false;

	protected $casts = [
		'idservices' => 'int',
		'idcustomers' => 'int',
		'amount' => 'float',
		'date' => 'datetime',
		'expiration_date' => 'datetime',
		'state' => 'int'
	];

	protected $fillable = [
		'idservices',
		'idcustomers',
		'amount',
		'date',
		'expiration_date',
		'state'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'idcustomers');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'idservices');
	}

	public function payments()
	{
		return $this->hasMany(Payment::class, 'idservices_customers');
	}
}
