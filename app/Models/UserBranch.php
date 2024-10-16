<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserBranch
 * 
 * @property int $userbranch_id
 * @property int $user_id
 * @property int $branch_id
 *
 * @package App\Models
 */
class UserBranch extends Model
{
	protected $table = 'user_branch';
	protected $primaryKey = 'userbranch_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'branch_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'branch_id'
	];
}
