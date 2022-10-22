<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable=['category_id','name','status'];
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function permission()
    {
        return $this->hasMany(FieldPermission::class, 'subcategory_id','id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class,'subcategory_id','id')->where('status',2);
    }
}
