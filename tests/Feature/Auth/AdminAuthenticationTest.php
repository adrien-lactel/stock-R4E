<?php

use App\Models\User;

test('admin is redirected to admin dashboard after login', function () {
    // create admin with known password (factory uses 'password')
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->post('/login', [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin);
    $response->assertRedirect(route('admin.dashboard'));
});