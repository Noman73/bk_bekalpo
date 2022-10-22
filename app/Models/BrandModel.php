<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id','name'];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function posts(){
        return $this->hasMany(Post::class,'model_id','id')->where('status',2);
    }
}
