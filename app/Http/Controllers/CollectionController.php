<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\UserPlantCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function store(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'collection_type' => 'required|in:have,had,want',
        ]);

        $user = Auth::user();
        $existingCollection = UserPlantCollection::where('user_id', $user->id)
            ->where('plant_id', $plant->id)
            ->first();

        // If a collection already exists, remove it first
        if ($existingCollection) {
            $existingCollection->delete();
        }

        // Create a new collection entry
        UserPlantCollection::create([
            'user_id' => $user->id,
            'plant_id' => $plant->id,
            'collection_type' => $validated['collection_type'],
        ]);

        return redirect()->route('plants.show', $plant->id)->with('success', 'Collection updated.');
    }

    public function remove(Plant $plant)
    {
        $user = Auth::user();
        $collection = UserPlantCollection::where('user_id', $user->id)
            ->where('plant_id', $plant->id)
            ->first();

        if ($collection) {
            $collection->delete();
        }

        return redirect()->route('plants.show', $plant->id)->with('success', 'Plant removed from collection.');
    }
}
