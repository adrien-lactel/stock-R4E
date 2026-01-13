<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'city' => $this->faker->city(),
        ];
    }
}