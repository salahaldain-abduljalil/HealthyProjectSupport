<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogpost extends Model
{
    protected $guarded = [];

    public function users(){

        return $this->belongsTo(User::class);
    }
    public function comments(){

        return $this->hasMany(Comment::class,'post_id','id');
    }
}
