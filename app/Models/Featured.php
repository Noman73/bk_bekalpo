<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;
class Featured extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','package_id','user_id','status','author_id','end_ad_at'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id','id')->with('permission','division','district','brand','model','images')->where('status',2);
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }
}
