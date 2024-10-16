<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fragrance
 * 
 * @property int $fragrance_id
 * @property string $name_fragrance
 * @property int $typefragrance_id
 * @property string|null $new_name
 * @property string|null $img
 * @property string|null $description
 * @property int $gender_id
 * @property int $state
 * 
 * @property Collection|Warehouse[] $warehouses
 *
 * @package App\Models
 */
class Fragrance extends Model
{
	protected $table = 'fragrance';
	protected $primaryKey = 'fragrance_id';
	public $timestamps = false;

	protected $casts = [
		'typefragrance_id' => 'int',
		'gender_id' => 'int',
		'state' => 'int'
	];

	protected $fillable = [
		'name_fragrance',
		'typefragrance_id',
		'new_name',
		'img',
		'description',
		'gender_id',
		'state'
	];

	public function warehouses()
	{
		return $this->hasMany(Warehouse::class);
	}
}
