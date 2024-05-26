<?php

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    protected $model = Articles::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'note' => $this->faker->numberBetween(60, 100),
            'prix_public' => $this->faker->randomFloat(2, 50, 500),
            'img' => $this->faker->imageUrl(),
        ];
    }
}
