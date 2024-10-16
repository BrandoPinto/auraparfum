<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BranchStock
 * 
 * @property int $branchstock_id
 * @property int $fragrance_id
 * @property int $branch_id
 * @property int $stock
 * @property int $containers_id
 * @property int|null $state
 * 
 * @property Collection|Sale[] $sales
 *
 * @package App\Models
 */
class BranchStock extends Model
{
	protected $table = 'branch_stock';
	protected $primaryKey = 'branchstock_id';
	public $timestamps = false;

	protected $casts = [
		'fragrance_id' => 'int',
		'branch_id' => 'int',
		'stock' => 'int',
		'containers_id' => 'int',
		'state' => 'int'
	];

	protected $fillable = [
		'fragrance_id',
		'branch_id',
		'stock',
		'containers_id',
		'state'
	];

	public function sales()
	{
		return $this->hasMany(Sale::class, 'branchstock_id');
	}
}
