<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'content',
        'expirable',
        'commentable',
        'access',
        'likes',
        'dislikes',
    ];

    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function users()
    {
        return $this->belongsTo(User::class);
    }


}
