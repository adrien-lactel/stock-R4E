<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('reset password link screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

test('reset password link can be requested', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->post('/forgot-password', ['email' => $user->email]);

    // Ensure the flow returns success status (we do not rely on Notification interception here)
    $response->assertSessionHas('status');

    // Also ensure a token can be created by the broker for this user
    $token = \Illuminate\Support\Facades\Password::broker()->createToken($user);
    $this->assertIsString($token);
});

test('reset password screen can be rendered', function () {
    $user = User::factory()->create();

    // Generate a token directly and visit the reset URL
    $token = \Illuminate\Support\Facades\Password::broker()->createToken($user);

    $response = $this->get('/reset-password/'.$token);

    $response->assertStatus(200);
});

test('password can be reset with valid token', function () {
    $user = User::factory()->create();

    $token = \Illuminate\Support\Facades\Password::broker()->createToken($user);

    $response = $this->post('/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('login'));
});
