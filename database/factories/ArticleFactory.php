<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\Store;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'store_id' => Store::inRandomOrder()->first()->id,
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(10, 200),
            'quantity' => $this->faker->numberBetween(1, 50),
        ];
    }
}
