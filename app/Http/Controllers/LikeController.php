<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;

use function PHPUnit\Framework\isEmpty;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like(Request $request, $id)
    {
        $like = Like::where('user_id', Auth::user()->id)
            ->where('article_id', $id)
            ->exists();

        if ($like == true) {
            Like::where('user_id', Auth::user()->id)
                ->where('article_id', $id)
                ->delete();
            return redirect()->back();
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'article_id' => $id,
            ]);
            return redirect()->back();
        }
    }
}
