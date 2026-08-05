<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titleEn = ucfirst($this->faker->sentence(6));
        $titleId = ucfirst($this->faker->sentence(6));

        return [
            'title' => [
                'en' => $titleEn,
                'id' => $titleId,
            ],
            'slug' => [
                'en' => Str::slug($titleEn),
                'id' => Str::slug($titleId),
            ],
            'short_description' => [
                'en' => $this->faker->sentence(12),
                'id' => $this->faker->sentence(12),
            ],
            'body_content' => [
                'en' => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p>',
                'id' => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p>',
            ],
            'meta_title' => [
                'en' => Str::limit($titleEn, 60, ''),
                'id' => Str::limit($titleId, 60, ''),
            ],
            'meta_description' => [
                'en' => $this->faker->sentence(20),
                'id' => $this->faker->sentence(20),
            ],
            'meta_keyword' => [
                'en' => implode(', ', $this->faker->words(5)),
                'id' => implode(', ', $this->faker->words(5)),
            ],
        ];
    }
}
