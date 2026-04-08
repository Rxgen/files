<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PetrochemicalsProductType;

class PetrochemicalsProduct extends Model
{
    public function product_types()
    {
        return $this->hasMany(PetrochemicalsProductType::class, 'product_id', 'id');
    }
}