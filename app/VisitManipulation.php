<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitManipulation extends Model
{
    protected $table = 'visit_manipulations';

    public function manipulation()
    {
        return $this->hasOne(Manipulation::class, 'id', 'manipulation_id');
    }
}
