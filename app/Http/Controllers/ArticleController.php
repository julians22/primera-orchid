<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\StickyArticle;
use App\Models\PageSetting;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $stickyArticle = StickyArticle::first();

        $articles = Article::query()
            ->when($request->filled('category'), function ($query) use ($request, $locale) {
                $category = $request->input('category');
                $query->whereHas('categories', function ($q) use ($category, $locale) {
                    $q->where("slug->{$locale}", $category)
                      ->orWhere('slug->en', $category);
                });
            })
            ->when($request->filled('tag'), function ($query) use ($request, $locale) {
                $tag = $request->input('tag');
                $query->whereHas('tags', function ($q) use ($tag, $locale) {
                    $q->where("slug->{$locale}", $tag)
                      ->orWhere('slug->en', $tag);
                });
            })
            ->latest()
            ->paginate(9);

        $meta = $this->getMeta();

        return view('pages.articles.index', compact('stickyArticle', 'articles', 'meta'));
    }

    private function getMeta(): array
    {
        $locale = app()->getLocale();

        $seoRecord = PageSetting::where('page_key', 'articles')
            ->where('section_key', 'seo_meta')
            ->first();

        $payload = $seoRecord->payload ?? [];

        $getString = function ($value) use ($locale) {
            if (is_string($value)) {
                return $value;
            }

            if (is_array($value)) {
                return $value[$locale] ?? reset($value) ?? '';
            }

            return '';
        };

        $title = $getString(
            $payload["meta_title_{$locale}"]
                ?? $payload['meta_title_en']
                ?? null
        );

        $description = $getString(
            $payload["meta_description_{$locale}"]
                ?? $payload['meta_description_en']
                ?? null
        );

        return [
            'title' => $title ?: 'Articles',
            'description' => $description ?: 'Welcome to Primera Orchid official website.',
        ];
    }

    public function show(string $article)
    {
        $locale = app()->getLocale();

        $article = Article::where("slug->{$locale}", $article)
            ->orWhere('slug->en', $article)
            ->orWhere('id', $article)
            ->firstOrFail();

        return view('pages.articles.show', compact('article'));
    }
}