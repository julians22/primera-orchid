<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleCategory>
 */
class ArticleCategoryFactory extends Factory
{
    protected $model = ArticleCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titleEn = ucfirst($this->faker->words(2, true));
        $titleId = ucfirst($this->faker->words(2, true));

        return [
            'title' => [
                'en' => $titleEn,
                'id' => $titleId,
            ],
            'slug' => [
                'en' => Str::slug($titleEn),
                'id' => Str::slug($titleId),
            ],
        ];
    }
}
