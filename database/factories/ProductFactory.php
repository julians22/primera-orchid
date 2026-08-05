<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(4, true);
        $slug = str($name)->slug('-');

        return [
            'name' => [
                'en' => $name,
                'id' => $this->faker->words(4, true),
            ],
            'slug' => [
                'en' => $slug,
                'id' => str($this->faker->words(4, true))->slug('-'),
            ],
            'short_description' => [
                'en' => $this->faker->sentence(),
                'id' => $this->faker->sentence(),
            ],
            'body_content' => [
                'en' => $this->faker->paragraphs(3, true),
                'id' => $this->faker->paragraphs(3, true),
            ],
            'attributes' => $this->faker->sentence(),
            'is_best_seller' => $this->faker->boolean(30),
        ];
    }
}
