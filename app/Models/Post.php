<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = ['user_id', 'type', 'title', 'content', 'image'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->votes()->where('is_upvote', true)->count();
    }

    public function dislikes()
    {
        return $this->votes()->where('is_upvote', false)->count();
    }

    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }
}
