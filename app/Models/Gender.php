<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 * 
 * @property int $gender_id
 * @property string|null $gender
 *
 * @package App\Models
 */
class Gender extends Model
{
	protected $table = 'gender';
	protected $primaryKey = 'gender_id';
	public $timestamps = false;

	protected $fillable = [
		'gender'
	];
}
