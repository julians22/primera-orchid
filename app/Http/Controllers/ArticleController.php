<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\StickyArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $stickyArticle = StickyArticle::first();

        $articles = Article::query()
            ->when($request->has('category'), function ($query) use ($request) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->where('slug', $request->input('category'));
                });
            })
            ->when($request->has('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($query) use ($request) {
                    $query->where('slug', $request->input('tag'));
                });
            })
            ->paginate(9);


        return view('pages.articles.index', compact('stickyArticle', 'articles'));
    }

    public function show(string $article)
    {
        $article = Article::where('slug->en', $article)->firstOrFail();

        $previousArticle = Article::where('id', '<', $article->id)->orderBy('id', 'desc')->first();
        $nextArticle = Article::where('id', '>', $article->id)->orderBy('id', 'asc')->first();

        return view('pages.articles.show', compact('article', 'previousArticle', 'nextArticle'));
    }
}
