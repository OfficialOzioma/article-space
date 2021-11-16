<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'article_id', 'comment'];

    /**
     *
     * Get the Article that owns the comment.
     *
     */

    public function Article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     *
     * Get the User that owns the comment.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}