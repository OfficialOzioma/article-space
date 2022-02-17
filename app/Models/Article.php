<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'categories_id',
        'visibility',
        'article',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'string',
        'article_id' => 'int',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
     * Get the User that owns the Article.
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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
        return $this->hasMany(Like::class, 'article_id');
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