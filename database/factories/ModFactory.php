<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mod;

class ModFactory extends Factory
{
    protected $model = Mod::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'purchase_price' => $this->faker->randomFloat(2, 5, 250),
            'quantity' => $this->faker->numberBetween(0, 25),
            'is_accessory' => $this->faker->boolean(30),
        ];
    }
}