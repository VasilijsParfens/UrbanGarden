<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship to get followers
    public function followers()
    {
        return $this->hasMany(Follower::class, 'followed_id');
    }

    // Relationship to get users this user is following
    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function plantComments()
    {
        return $this->hasMany(PlantComment::class);
    }

    public function plantCollections()
    {
        return $this->hasMany(UserPlantCollection::class);
    }

    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'user_plant_collections')
                    ->withPivot('collection_type')
                    ->withTimestamps(); // Assuming there's a created_at and updated_at column in your pivot table
    }


    public function questionComments()
    {
        return $this->hasMany(QuestionComment::class);
    }

}
