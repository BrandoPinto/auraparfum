<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Container
 * 
 * @property int $containers_id
 * @property string $ml
 * @property float $cost
 * @property int|null $state
 * 
 * @property Collection|Warehouse[] $warehouses
 *
 * @package App\Models
 */
class Container extends Model
{
	protected $table = 'containers';
	protected $primaryKey = 'containers_id';
	public $timestamps = false;

	protected $casts = [
		'cost' => 'float',
		'state' => 'int'
	];

	protected $fillable = [
		'ml',
		'cost',
		'state'
	];

	public function warehouses()
	{
		return $this->hasMany(Warehouse::class, 'containers_id');
	}
}
