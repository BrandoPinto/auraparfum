<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StockHistory
 * 
 * @property int $stock_history_id
 * @property int $warehouse_id
 * @property int $branch_id
 * @property int $stock
 * @property Carbon $date
 * 
 * @property Branch $branch
 * @property Warehouse $warehouse
 *
 * @package App\Models
 */
class StockHistory extends Model
{
	protected $table = 'stock_history';
	protected $primaryKey = 'stock_history_id';
	public $timestamps = false;

	protected $casts = [
		'warehouse_id' => 'int',
		'branch_id' => 'int',
		'stock' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'warehouse_id',
		'branch_id',
		'stock',
		'date'
	];

	public function branch()
	{
		return $this->belongsTo(Branch::class);
	}

	public function warehouse()
	{
		return $this->belongsTo(Warehouse::class);
	}
}
