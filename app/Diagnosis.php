<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $table = 'diagnosis';

    public function disease()
    {
        return $this->hasOne(Disease::class, 'id', 'disease_id');
    }
}
