<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function bookmark_articles()
    {
        $articles = Auth::user()->bookmark_articles()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'articles' => $articles,
        ];
        return view('show', $data);
    }

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        $data = ['articles' => $articles];
        return view('articles.index', $data);
    }
}
