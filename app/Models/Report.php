<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['description','post_id','user_id'];

    function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
