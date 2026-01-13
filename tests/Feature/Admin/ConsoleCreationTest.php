<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Ensure taxonomy exists
    ArticleCategory::factory()->create(['id' => 1, 'name' => 'Cat A']);
    ArticleSubCategory::factory()->create(['id' => 1, 'article_category_id' => 1, 'name' => 'Sub A']);
    ArticleType::factory()->create(['id' => 1, 'article_sub_category_id' => 1, 'name' => 'Type A']);
});

test('admin can create console without store_id', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('admin.articles.store'), [
        'article_category_id' => 1,
        'article_sub_category_id' => 1,
        'article_type_id' => 1,
        'status' => 'stock',
        'prix_achat' => 40,
        'valorisation' => 90,
    ]);

    $response->assertRedirect(route('admin.articles.create'));
    $this->assertDatabaseHas('consoles', ['prix_achat' => 40, 'valorisation' => 90]);
});