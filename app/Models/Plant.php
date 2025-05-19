<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'scientific_name',
        'image',
        'watering_frequency',
        'sunlight',
        'soil_type',
        'fertilizing',
        'additional_info',
    ];

    public function comments()
    {
        return $this->hasMany(PlantComment::class);
    }

    public function userCollections()
    {
        return $this->hasMany(UserPlantCollection::class);
    }

    // Relationship for plants the user has
    public function plantsIHave()
    {
        return $this->belongsToMany(Plant::class, 'user_plants', 'user_id', 'plant_id')
                    ->wherePivot('type', 'have');
    }

    // Relationship for plants the user wants
    public function plantsIWant()
    {
        return $this->belongsToMany(Plant::class, 'user_plants', 'user_id', 'plant_id')
                    ->wherePivot('type', 'want');
    }

    public function plantsIHad()
    {
        return $this->belongsToMany(Plant::class, 'user_plants', 'user_id', 'plant_id')
                    ->wherePivot('type', 'had');
    }


}
