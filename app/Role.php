<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	const ROLE_DOCTOR = 3;

    protected $table = 'model_has_roles';
}
