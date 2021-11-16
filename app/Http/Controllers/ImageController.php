<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $article = new Article();
        $article->id = 0;
        $article->exists = true;
        $image = $article
            ->addMediaFromRequest(key:'upload')
            ->toMediaCollection(collectionName:'images');
        return response()->json([
            'url' => $image->getUrl(),
        ]);
    }
}
