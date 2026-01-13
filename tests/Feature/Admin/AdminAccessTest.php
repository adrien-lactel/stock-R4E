<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

test('store user cannot access admin dashboard', function () {
    $storeUser = User::factory()->create(['role' => 'store']);

    $response = $this->actingAs($storeUser)->get(route('admin.dashboard'));

    $response->assertForbidden();
});

test('admin user can access admin dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertOk();
});

test('store user cannot access store creation page (admin)', function () {
    $storeUser = User::factory()->create(['role' => 'store']);

    $response = $this->actingAs($storeUser)->get(route('admin.stores.create'));

    $response->assertForbidden();
});