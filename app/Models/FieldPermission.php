<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldPermission extends Model
{
    use HasFactory;
    protected $fillable = ['field_name','status','author_id'];
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id','id');
    }
}
