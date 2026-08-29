<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;

class NewsController extends Controller
{
    public function index()
    {
        // Single unified feed, sorted by latest published, tagged by category
        $articles = NewsArticle::published()
            ->orderByDesc('published_at')
            ->get();

        $featured = $articles->first();
        $rest = $articles->skip(1);

        return view('pages.blog', compact('articles', 'featured', 'rest'));
    }
}
