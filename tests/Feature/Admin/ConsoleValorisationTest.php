<?php

test('modification du prix R4E ne touche qu\'un seul article', function () {
    $console1 = \App\Models\Console::factory()->create(['valorisation' => 100]);
    $console2 = \App\Models\Console::factory()->create(['valorisation' => 200]);

    $admin = \App\Models\User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->put(url('/admin/articles/' . $console1->id), [
            'valorisation' => 123.45,
            // champs obligatoires pour updateArticle
            'article_category_id' => $console1->article_category_id ?? 1,
            'article_sub_category_id' => $console1->article_sub_category_id ?? 1,
            'article_type_id' => $console1->article_type_id ?? 1,
            'status' => $console1->status ?? 'stock',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('consoles', [
        'id' => $console1->id,
        'valorisation' => 123.45,
    ]);
    $this->assertDatabaseHas('consoles', [
        'id' => $console2->id,
        'valorisation' => 200,
    ]);
});
