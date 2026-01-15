<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ArticleType;
use App\Models\ArticleSubCategory;

/**
 * @extends Factory<ArticleType>
 */
class ArticleTypeFactory extends Factory
{
    protected $model = ArticleType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'article_sub_category_id' => ArticleSubCategory::factory(),
        ];
    }
}
