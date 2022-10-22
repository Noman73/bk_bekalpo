<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelTypeMark extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function fueltype()
    {
        return $this->belongsTo(FuelType::class,'fueltype_id','id');
    }
}
