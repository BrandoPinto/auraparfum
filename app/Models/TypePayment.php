<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypePayment
 * 
 * @property int $typepayment_id
 * @property string $type_payment
 * @property int|null $state
 *
 * @package App\Models
 */
class TypePayment extends Model
{
	protected $table = 'type_payment';
	protected $primaryKey = 'typepayment_id';
	public $timestamps = false;

	protected $casts = [
		'state' => 'int'
	];

	protected $fillable = [
		'type_payment',
		'state'
	];
}
