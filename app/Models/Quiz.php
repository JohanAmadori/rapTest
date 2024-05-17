<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';
    protected $fillable = ['rappeur_id', 'question', 'reponse1', 'reponse2', 'reponse3', 'reponse4', 'reponse', 'difficulte'];

    public function responses()
    {
        return $this->hasMany(UserReponse::class);
    }

}






