<?php

namespace Database\Factories;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $slug = str($name)->slug('-');

        return [
            'name' => [
                'en' => $name,
                'id' => $this->faker->words(3, true),
            ],
            'slug' => [
                'en' => $slug,
                'id' => str($this->faker->words(3, true))->slug('-'),
            ],
            'short_description' => [
                'en' => $this->faker->sentence(),
                'id' => $this->faker->sentence(),
            ],
            'body_content' => [
                'en' => $this->faker->paragraphs(2, true),
                'id' => $this->faker->paragraphs(2, true),
            ],
            'body_content_pos' => $this->faker->randomElement(['left', 'right']),
        ];
    }
}
