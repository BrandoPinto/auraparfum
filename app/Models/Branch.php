<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Branch
 * 
 * @property int $branch_id
 * @property string $name_branch
 * @property string|null $location
 * @property int $typework_id
 * @property string $state
 * 
 * @property TypeWork $type_work
 * @property Collection|StockHistory[] $stock_histories
 *
 * @package App\Models
 */
class Branch extends Model
{
	protected $table = 'branch';
	protected $primaryKey = 'branch_id';
	public $timestamps = false;

	protected $casts = [
		'typework_id' => 'int'
	];

	protected $fillable = [
		'name_branch',
		'location',
		'typework_id',
		'state'
	];

	public function type_work()
	{
		return $this->belongsTo(TypeWork::class, 'typework_id');
	}

	public function stock_histories()
	{
		return $this->hasMany(StockHistory::class);
	}
}
