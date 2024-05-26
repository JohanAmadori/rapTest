<?php

namespace Database\Factories;

use App\Models\Panier;
use App\Models\User;
use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class PanierFactory extends Factory
{
    protected $model = Panier::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'article_id' => Articles::factory(),
            'quantite' => 1,
            'valeur' => $this->faker->numberBetween(50, 500),
        ];
    }
}
