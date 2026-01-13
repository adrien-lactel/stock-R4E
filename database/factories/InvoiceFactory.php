<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition()
    {
        return [
            // Ces valeurs ne seront normalement pas utilisées si on crée via afterCreating()
            'store_id' => null,
            'console_id' => null,
            'amount' => 0,
            'status' => $this->faker->randomElement(['paid', 'unpaid']),
            'invoice_date' => now(),
            'issued_at' => now(),
        ];
    }
}
