<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PatientForm043 extends Model
{
	protected $table = 'patient_form043';

    protected $fillable = [
        'diagnose', 'complaint', 'transferred_diseases', 'current_disease','research_data', 'patient_id'
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function patient()
	{
		return $this->hasOne(Patient::class, 'id', 'patient_id');
	}

}
