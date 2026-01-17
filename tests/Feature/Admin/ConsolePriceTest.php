<?php

/** @var Tests\TestCase $this */

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Store;
use App\Models\Console;

uses(RefreshDatabase::class);

beforeEach(function () {
    // ensure a store exists
    Store::factory()->create(['id' => 2]);
});

test('admin can create console offer for a store', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $console = Console::factory()->create(['id' => 1, 'status' => 'stock']);
    $store = Store::first();

    $response = $this->actingAs($admin)->post(route('admin.consoles.prices.store', $console), [
        'offers' => [
            $store->id => 50,
        ],
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('console_offers', [
        'console_id' => $console->id,
        'store_id' => $store->id,
        'sale_price' => 50,
        'status' => 'proposed',
    ]);
});