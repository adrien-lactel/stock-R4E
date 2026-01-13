<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Console;

uses(RefreshDatabase::class);

test('edit-full form no longer contains identite_reparateur field', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $console = Console::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.articles.edit_full', $console));

    $response->assertOk();
    $response->assertDontSee('Identité réparateur');
    $response->assertDontSee('identite_reparateur');
});

test('consoles table does not have identite_reparateur column', function () {
    $this->assertFalse(Schema::hasColumn('consoles', 'identite_reparateur'));
});
