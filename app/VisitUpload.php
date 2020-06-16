<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitUpload extends Model
{
	const UPLOAD_PATH = '/image/visit/patient_%s/';

    const TYPE_3D         = 1;
    const TYPE_ADDITIONAL = 2;
}
