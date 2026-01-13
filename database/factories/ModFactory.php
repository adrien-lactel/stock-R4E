<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mod;
use App\Models\Console;

class ModFactory extends Factory
{
    protected $model = Mod::class;

    public function definition(): array
    {
        return [
            'console_id' => Console::inRandomOrder()->first()->id,
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(5, 100),
        ];
    }
}