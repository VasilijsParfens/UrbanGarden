<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function votes()
    {
        return $this->hasMany(CommentVote::class);
    }

    public function likes()
    {
        return $this->votes()->where('is_upvote', true)->count();
    }

    public function dislikes()
    {
        return $this->votes()->where('is_upvote', false)->count();
    }
}
