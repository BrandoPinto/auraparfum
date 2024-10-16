<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Warehouse
 * 
 * @property int $warehouse_id
 * @property int $fragrance_id
 * @property int $containers_id
 * @property int $stock
 * 
 * @property Container $container
 * @property Fragrance $fragrance
 * @property Collection|StockHistory[] $stock_histories
 *
 * @package App\Models
 */
class Warehouse extends Model
{
	protected $table = 'warehouse';
	protected $primaryKey = 'warehouse_id';
	public $timestamps = false;

	protected $casts = [
		'fragrance_id' => 'int',
		'containers_id' => 'int',
		'stock' => 'int'
	];

	protected $fillable = [
		'fragrance_id',
		'containers_id',
		'stock'
	];

	public function container()
	{
		return $this->belongsTo(Container::class, 'containers_id');
	}

	public function fragrance()
	{
		return $this->belongsTo(Fragrance::class);
	}

	public function stock_histories()
	{
		return $this->hasMany(StockHistory::class);
	}
}
