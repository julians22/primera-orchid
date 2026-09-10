<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\StickyArticle;
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

        return view('pages.articles.index', compact('stickyArticle', 'articles'));
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