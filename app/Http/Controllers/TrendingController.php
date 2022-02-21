<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Article;

class TrendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trending = Article::join(
            'likes',
            'articles.id',
            '=',
            'likes.article_id'
        )
            ->selectRaw('articles.*, count(likes.article_id) as totalLike')
            ->groupBy('articles.id')
            ->get();
        // dd(!count($trending) == 0);
        return view('trending', compact('trending'));
    }
}