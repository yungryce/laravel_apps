<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public function comments(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
