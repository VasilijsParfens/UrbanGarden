<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use Illuminate\Support\Str;


class PlantController extends Controller
{

    public function show($id)
    {
        // Load the plant and its related comments (with the user who posted each comment)
        $plant = Plant::with('comments.user')->findOrFail($id);

        // Check if the user is authenticated and retrieve their collection type for the plant
        if (auth()->check()) {
            $userCollectionType = auth()->user()->plants()
                ->where('plant_id', $id)
                ->pluck('collection_type')
                ->first(); // Get the first (or only) collection type for this plant
        } else {
            $userCollectionType = null; // If no user is authenticated, set to null
        }

        // Return the view with the plant and the user's collection type (if authenticated)
        return view('plants.show', compact('plant', 'userCollectionType'));
    }

    public function index(Request $request)
    {
        $query = Plant::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by sunlight
        if ($request->filled('sunlight')) {
            $query->where('sunlight', $request->sunlight);
        }

        // Filter by watering frequency
        if ($request->filled('watering_frequency')) {
            $query->where('watering_frequency', $request->watering_frequency);
        }

        // Filter by soil type
        if ($request->filled('soil_type')) {
            $query->where('soil_type', $request->soil_type);
        }

        // Filter by fertilizing
        if ($request->filled('fertilizing')) {
            $query->where('fertilizing', $request->fertilizing);
        }

        // Sorting
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
            }
        } else {
            $query->latest();
        }

        $plants = $query->paginate(12)->withQueryString();

        return view('plants.index', compact('plants'));
    }



}
