<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'follower_id', // The user who is following
        'followed_id', // The user being followed
    ];

    // Relationship to the follower (user who is following)
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    // Relationship to the followed user (user being followed)
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
