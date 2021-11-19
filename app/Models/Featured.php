<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    use HasFactory;

    /**
     *
     * Get the Article is been featured.
     *
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}