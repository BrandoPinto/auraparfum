<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeWork
 * 
 * @property int $typework_id
 * @property string $type
 * @property int $state
 * 
 * @property Collection|Branch[] $branches
 *
 * @package App\Models
 */
class TypeWork extends Model
{
	protected $table = 'type_work';
	protected $primaryKey = 'typework_id';
	public $timestamps = false;

	protected $casts = [
		'state' => 'int'
	];

	protected $fillable = [
		'type',
		'state'
	];

	public function branches()
	{
		return $this->hasMany(Branch::class, 'typework_id');
	}
}
