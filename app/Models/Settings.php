<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'profile_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'profile_pic', 'bio'];

    /*
     * Get the User that owns the settings.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}