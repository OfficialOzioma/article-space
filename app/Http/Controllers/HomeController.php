<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request)
    {
        $articles = Article::where('visibility', 'public')
            ->with(['user', 'comments', 'like', 'view'])
            ->latest()
            ->paginate(6);

        return view('home', compact('articles'))->with(
            'i',
            (request()->input('page', 1) - 1) * 6
        );
    }
}
