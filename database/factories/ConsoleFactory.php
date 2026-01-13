<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Console;
use App\Models\Store;
use App\Models\ConsoleType;

/**
 * @extends Factory<Console>
 */
class ConsoleFactory extends Factory
{
    protected $model = Console::class;

    public function definition()
    {
        // Status aléatoire
        $statuses = ['stock', 'vendue', 'defectueuse'];

        return [
            'store_id' => optional(Store::inRandomOrder()->first())->id ?? Store::factory()->create()->id,
            'console_type_id' => optional(ConsoleType::inRandomOrder()->first())->id ?? ConsoleType::factory()->create()->id,
            'status' => $this->faker->randomElement($statuses),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Console $console) {
            // Crée une facture uniquement si la console est vendue
            if ($console->status === 'vendue') {
                $console->invoice()->create([
                    'store_id' => $console->store_id,
                    'amount' => $console->real_value,
                    'status' => 'paid', // ou 'unpaid' si tu veux
                    'invoice_date' => now(),
                    'issued_at' => now(),
                ]);
            }
        });
    }
}
