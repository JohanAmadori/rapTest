<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserReponse;

class UserReponseFactory extends Factory
{
    protected $model = UserReponse::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'question_id' => \App\Models\Quiz::factory(),
        ];
    }
}

