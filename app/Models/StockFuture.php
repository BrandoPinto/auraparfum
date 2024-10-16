<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StockFuture
 * 
 * @property int $stock_future_id
 * @property int $fragrance_id
 * @property int $containers_id
 * @property int $stock
 * @property Carbon $date
 * @property int $state
 *
 * @package App\Models
 */
class StockFuture extends Model
{
	protected $table = 'stock_future';
	protected $primaryKey = 'stock_future_id';
	public $timestamps = false;

	protected $casts = [
		'fragrance_id' => 'int',
		'containers_id' => 'int',
		'stock' => 'int',
		'date' => 'datetime',
		'state' => 'int'
	];

	protected $fillable = [
		'fragrance_id',
		'containers_id',
		'stock',
		'date',
		'state'
	];
}
