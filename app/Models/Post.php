<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Allow mass-assignment for these fields
    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwnedByUser($user)
    {
        return $this->user_id === $user?->id;
    }

    /**
     * Get the comments for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Get the likes for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    /**
     * Check if the post is liked by a specific user.
     *
     * @param \App\Models\User|null $user
     * @return bool
     */
    public function isLikedByUser($user)
    {
        return $user ? $this->likes()->where('user_id', $user->id)->exists() : false;
    }
}
