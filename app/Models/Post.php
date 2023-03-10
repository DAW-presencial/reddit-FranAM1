<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'likes',
        'dislikes',
        'user_id',
        'community_id',
    ];

    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function community()
    {
        return $this->belongsTo(Community::class);
    }
}
