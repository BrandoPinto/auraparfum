<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $idpayments
 * @property int $idservices_customers
 * @property int $date
 * @property float $amount
 * @property string|null $document
 * 
 * @property ServicesCustomer $services_customer
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payments';
	protected $primaryKey = 'idpayments';
	public $timestamps = false;

	protected $casts = [
		'idservices_customers' => 'int',
		'date' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'idservices_customers',
		'date',
		'amount',
		'document'
	];

	public function services_customer()
	{
		return $this->belongsTo(ServicesCustomer::class, 'idservices_customers');
	}
}
