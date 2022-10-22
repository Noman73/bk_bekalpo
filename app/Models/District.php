<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = ['division_id','name','status','author_id'];
    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
    }
}
