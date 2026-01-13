<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Models\User;

uses(RefreshDatabase::class);

test('forgot-password stores a token in the password_reset_tokens table', function () {
    $user = User::factory()->create();

    $response = $this->post('/forgot-password', ['email' => $user->email]);

    $response->assertSessionHas('status');

    $table = config('auth.passwords.'.config('auth.defaults.passwords').'.table');

    $row = DB::table($table)->where('email', $user->email)->first();

    expect($row)->not->toBeNull();
    expect($row->token)->not->toBeNull();
    expect($row->created_at)->not->toBeNull();
});

test('password broker token exists for generated token', function () {
    $user = User::factory()->create();

    $token = Password::broker()->createToken($user);

    $this->assertTrue(Password::broker()->tokenExists($user, $token));
});
