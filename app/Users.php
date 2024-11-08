<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	
	protected $connection = 'mysql';

	protected $table = 'users';

	protected $fillable = [
		'firstname',
		'lastname',
		'username',
		'password',
		'emailaddress',
		'role',
		'status'
	];

	protected $hidden = [
		'password',
	];

	protected $dates = [ 'created_at', 'updated_at' ];

	protected $guard_name = 'web';

	public $timestamps = true;

}