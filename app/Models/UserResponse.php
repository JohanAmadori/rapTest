<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserResponse extends Model
{


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    
   
}



