<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    function users(){
        return $this->belongsTo('App\Models\User');
    }

    function posts(){
        return $this->belongsTo('App\Models\Posts');
    }
}

