<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function doctor()
    {
        return $this->hasOne(User::class, 'id', 'doctor_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function status_my()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnosis::class, 'visit_id', 'id');
    }

    public function visit_products()
    {
        return $this->hasMany(VisitProduct::class, 'visit_id', 'id');
    }

	public function visit_services()
	{
		return $this->hasMany(VisitService::class, 'visit_id', 'id');
	}

	public function visit_manipulations()
	{
		return $this->hasMany(VisitManipulation::class, 'visit_id', 'id');
	}
}
