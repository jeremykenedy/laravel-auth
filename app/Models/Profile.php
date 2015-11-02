<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {







	/**
	 * A profile belongs to a user
	 *
	 * @return mixed
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}








}