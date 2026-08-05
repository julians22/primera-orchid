<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::factory(30)->create();

        $categories = ArticleCategory::all();
        $tags = Tag::all();

        foreach ($articles as $article) {
            if ($categories->isNotEmpty()) {
                $article->categories()->syncWithoutDetaching(
                    $categories->random(rand(1, min(3, $categories->count())))->pluck('id')->all(),
                );
            }

            if ($tags->isNotEmpty()) {
                $article->tags()->syncWithoutDetaching(
                    $tags->random(rand(2, min(6, $tags->count())))->pluck('id')->all(),
                );
            }
        }
    }
}
