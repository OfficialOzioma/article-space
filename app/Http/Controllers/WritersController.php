<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WritersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $writers = Article::groupBy('user_id')->get();
        $users = User::with('settings', 'articles')->get();
        // dd($users);


        $writers = Article::with('user')->orderBy('user_id')->get()->groupBy(function ($data) {
            return $data->user_id;
        });
        // $user = DB::table('articles')
        //     ->select('*')
        //     ->select('user_id', DB::raw('count(*) as total'))
        //     ->groupBy('user_id')
        //     ->pluck('total', 'user_id');

        // $user = DB::table('articles')
        //     ->join('users', 'users.id', '=', 'articles.user_id')
        //     ->select('users.id', DB::raw('COUNT(*) AS total'))
        //     ->groupBy('users.id')
        //     ->get();

        // dd($users->settings);

        return view('writer', compact('users'));
    }
}