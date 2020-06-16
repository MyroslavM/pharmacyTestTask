<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitService extends Model
{
    protected $table = 'visit_services';

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
