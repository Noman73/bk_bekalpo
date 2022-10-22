<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name','subcategory_id'];
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id','id');
        
    }
}
