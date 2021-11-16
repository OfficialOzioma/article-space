<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'article_id'];

    /**
     *
     * Get the Article that owns the view.
     *
     */

    public function Article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     *
     * Get the User that viewed the article.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}