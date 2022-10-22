<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name','status'];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class,'category_id','id');
    }
    public function postCount()
    {
        return $this->hasMany(Post::class,'category_id','id')->where('status',2);
    }


}
