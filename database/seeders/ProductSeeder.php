<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Collection;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(50)->create();

        // Attach products to random collections (Many to Many)
        $collections = Collection::all();
        foreach ($products as $product) {
            $product->collections()->attach(
                $collections->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        // Create related products relationships
        foreach ($products as $product) {
            $relatedProducts = $products
                ->where('id', '!=', $product->id)
                ->random(rand(2, 5));

            foreach ($relatedProducts as $related) {
                // Avoid duplicates - only create if reverse doesn't exist
                if (!$product->relatedProducts()->where('related_id', $related->id)->exists()) {
                    $product->relatedProducts()->attach($related->id);
                }
            }
        }
    }
}
