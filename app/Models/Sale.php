<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 * 
 * @property int $sales_id
 * @property int $idUser
 * @property int $customers_id
 * @property int $branchstock_id
 * @property Carbon $date
 * @property int $typepayment_id
 * 
 * @property BranchStock $branch_stock
 *
 * @package App\Models
 */
class Sale extends Model
{
	protected $table = 'sales';
	protected $primaryKey = 'sales_id';
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int',
		'customers_id' => 'int',
		'branchstock_id' => 'int',
		'date' => 'datetime',
		'typepayment_id' => 'int'
	];

	protected $fillable = [
		'idUser',
		'customers_id',
		'branchstock_id',
		'date',
		'typepayment_id'
	];

	public function branch_stock()
	{
		return $this->belongsTo(BranchStock::class, 'branchstock_id');
	}
}
