<?php

namespace Database\Factories;

use App\Models\ConsoleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsoleTypeFactory extends Factory
{
    protected $model = ConsoleType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['DMG', 'GBC', 'GBA', 'GBA SP', '3DS']),
            'average_purchase_price' => $this->faker->numberBetween(27, 70),
            'average_loss_percent' => $this->faker->numberBetween(5, 30),
        ];
    }
}