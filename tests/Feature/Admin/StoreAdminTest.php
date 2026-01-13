<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Store;
use App\Models\Console;

uses(RefreshDatabase::class);

test('admin can delete store without associations', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $store = Store::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.stores.destroy', $store));

    $response->assertRedirect(route('admin.stores.create'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('stores', ['id' => $store->id]);
});

test('cannot delete store with consoles attached', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $store = Store::factory()->create();
    $console = Console::factory()->create();

    // attach console via pivot
    $store->consoles()->attach($console->id, ['sale_price' => 123.45]);

    $response = $this->actingAs($admin)->delete(route('admin.stores.destroy', $store));

    $response->assertRedirect();
    $response->assertSessionHas('error');

    $this->assertDatabaseHas('stores', ['id' => $store->id]);
});

test('non-admin cannot delete store', function () {
    $user = User::factory()->create(['role' => 'store']);
    $store = Store::factory()->create();

    $response = $this->actingAs($user)->delete(route('admin.stores.destroy', $store));

    $response->assertForbidden();
    $this->assertDatabaseHas('stores', ['id' => $store->id]);
});