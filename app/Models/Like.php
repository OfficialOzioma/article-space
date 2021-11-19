<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'article_id'];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'string',
        'article_id' => 'string',
    ];


    /**
     *
     * Get the Article that owns the Like.
     *
     */

    public function Article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     *
     * Get the User that liked the article.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}