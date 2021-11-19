<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelFollow\Followable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Followable;

    public $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'username', 'password', 'role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_id' => 'int',
        'article_id' => 'int',
    ];

    /**
     *
     * Get all the Articles for the User.
     *
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     *
     * Get all the Comment for the User.
     *
     */

    public function comment()
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

    /**
     * Get the settings associated with the user.
     */
    public function settings()
    {
        return $this->hasOne(Settings::class, 'user_id');
    }
}