<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition()
    {
        return [
            'question' => $this->faker->sentence,
            'reponse1' => $this->faker->sentence,
            'reponse2' => $this->faker->sentence,
            'reponse3' => $this->faker->sentence,
            'reponse4' => $this->faker->sentence,
            'reponse' => $this->faker->numberBetween(1, 4),
            'rappeur_id' => null, // Assuming no specific rapper is linked
            'difficulte' => $this->faker->randomElement(['easy', 'medium', 'hard']),
        ];
    }
}
