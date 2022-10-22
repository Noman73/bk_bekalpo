<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function category(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class,'brand_id','id')->where('status',2);
    }
}
