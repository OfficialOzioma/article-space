<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\View;
use App\Models\Settings;
use App\Models\User;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:articles|max:100|min:3',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'visibility' => 'required',
            'editor' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(
                public_path('uploads/thumbnails'),
                $filename
            );
        }

        $article = Article::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->input('title'), '-'),
            'thumbnail' => $filename,
            'visibility' => $request->visibility,
            'categories_id' => $request->categories_id = "1",
            'article' => $request->editor,
        ]);

        if (!$article) {
            Session::flash('message', 'Error while creating article !');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        Session::flash('message', 'Article has been created successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function addView($article_id, $user_id)
    {
        $view = View::where('user_id', $user_id)
            ->where('article_id', $article_id)
            ->exists();

        if ($view == true) {
            return false;
        } else {
            View::create([
                'user_id' => $user_id,
                'article_id' => $article_id,
            ]);
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

        $findArticle = Article::where('slug', $article->slug)
            ->with(['user', 'comments', 'like'])
            ->first();
        $settings = Settings::find($findArticle->user->id);

        $user = User::Where('id', Auth::user()->id)
            ->with('settings')
            ->firstOrFail();

        $numberOfComments = $findArticle->comments->count();
        $this->addView($article->id, Auth::user()->id);

        return view(
            'article.show',
            compact('findArticle', 'numberOfComments', 'settings', 'user')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $article = Article::where('slug', $article->slug)->first();

        return view('article.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = [];
        $data['user_id'] = Auth::user()->id;
        $request->validate([
            'title' => 'required|string|max:100',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'editor' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(
                public_path('uploads/thumbnails'),
                $filename
            );
            $data['thumbnail'] = $filename;
        }

        if ($request->visibility != '') {
            $data['visibility'] = $request->visibility;
        }

        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->input('title'), '-');
        $data['article'] = $request->editor;
        // dd($data);

        $update = $article->update($data);
        if (!$update) {
            Session::flash('message', 'Error while Updating article !');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        Session::flash('message', 'Article has been updated successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('profile', Auth::user()->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        Session::flash('message', 'Article has been Deleted successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
