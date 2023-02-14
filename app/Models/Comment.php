<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    function user(){
        return $this->belongsTo(User::class);
    }

    function post(){
        return $this->belongsTo(Post::class);
    }
}

