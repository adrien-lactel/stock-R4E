<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Repairer;

class RepairerFactory extends Factory
{
    protected $model = Repairer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'notes' => $this->faker->sentence(),
            'is_active' => true,
            'delay_days_default' => $this->faker->numberBetween(1, 10),
            'shipping_method' => $this->faker->randomElement(['Chronopost', 'Colissimo', 'UPS']),
            'vat_number' => strtoupper($this->faker->bothify('FR###########')),
            'siret' => $this->faker->numerify('##############'),
        ];
    }
}
