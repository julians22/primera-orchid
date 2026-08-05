<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\StickyArticle;
use Illuminate\Database\Seeder;

class StickyArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stickyArticles = Article::query()
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $order = 1;

        foreach ($stickyArticles as $article) {
            StickyArticle::updateOrCreate(
                ['article_id' => $article->id],
                ['order_number' => $order],
            );

            $order++;
        }
    }
}
