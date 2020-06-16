<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    protected $table = 'work_time';


    public function doctor()
    {
        return $this->hasOne(User::class, 'id', 'doctor_id');
    }

    public function clinic()
    {
        return $this->hasOne(Clinic::class, 'id', 'clinic_id');
    }
}
