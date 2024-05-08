<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';

    public function responses()
    {
        return $this->hasMany(UserResponse::class);
    }

}






