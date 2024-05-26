<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory ;


    protected $table = 'quizs';
    protected $fillable = ['question', 'reponse1', 'reponse2', 'reponse3', 'reponse4', 'correct_option'];

    public function responses()
    {
        return $this->hasMany(UserReponse::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'user_responses')
                ->withPivot('answer_index', 'is_correct');
}


}






