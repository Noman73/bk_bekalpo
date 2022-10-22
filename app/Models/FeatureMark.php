<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureMark extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','feature_id','status'];

    public function feature()
    {
        return $this->belongsTo(Feature::class,'feature_id','id');
    }
}
