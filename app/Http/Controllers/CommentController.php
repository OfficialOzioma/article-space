<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addComment(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'comment' => 'required|string|unique:comments',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'article_id' => $id,
            'comment' => $request->comment,
        ]);

        if (!$comment) {
            Session::flash('message', 'Error while creating Comment !');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        Session::flash('message', 'Comment has been created successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}