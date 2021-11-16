<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'summary',
        'thumbnail',
        'visibility',
        'article',
    ];

    /**
     *
     * Get the User that owns the Article.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * Get the comments for the blog Article.
     *
     */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     *
     * Get all the Articles Liked by the User.
     *
     */
    public function like()
    {
        return $this->hasMany(Like::class);
    }

    /**
     *
     * Get all the Articles viewed by the User.
     *
     */

    public function view()
    {
        return $this->hasMany(View::class);
    }
}