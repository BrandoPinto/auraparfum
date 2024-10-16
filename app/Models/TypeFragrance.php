<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeFragrance
 * 
 * @property int $typefragrance_id
 * @property string $name_type
 * @property int $state
 *
 * @package App\Models
 */
class TypeFragrance extends Model
{
	protected $table = 'type_fragrance';
	protected $primaryKey = 'typefragrance_id';
	public $timestamps = false;

	protected $casts = [
		'state' => 'int'
	];

	protected $fillable = [
		'name_type',
		'state'
	];
}
