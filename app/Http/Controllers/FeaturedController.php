<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Featured;
class FeaturedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $featured = Featured::with('article')->get();
        // dd($featured);
        return view('featured', compact('featured'));
    }
}