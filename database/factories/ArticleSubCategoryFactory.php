<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleCategory;

/**
 * @extends Factory<ArticleSubCategory>
 */
class ArticleSubCategoryFactory extends Factory
{
    protected $model = ArticleSubCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'article_category_id' => ArticleCategory::factory(),
        ];
    }
}
