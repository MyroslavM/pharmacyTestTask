<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $table = 'black_list';

    public function user()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
}
