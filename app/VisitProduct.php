<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitProduct extends Model
{
    protected $table = 'visti_products';

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
