<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class AdminPlantController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        return view('admin.plants', compact('plants'));
    }

    public function create()
    {
        return view('plants.create');
    }

    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'scientific_name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image file
        'watering_frequency' => 'required|string',
        'sunlight' => 'required|string',
        'soil_type' => 'required|string',
        'fertilizing' => 'required|string',
        'additional_info' => 'nullable|string',
    ]);

    // Handle the image upload
    if ($request->hasFile('image')) {
        // Generate a unique name for the image using a timestamp and original extension
        $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

        // Store the image in the 'public/storage/images/plants' directory
        $request->file('image')->storeAs('images/plants', $imageName, 'public');
    }

    // Create a new Plant entry in the database
    Plant::create([
        'name' => $validated['name'],
        'scientific_name' => $validated['scientific_name'],
        'image' => $imageName, // Store the unique image name
        'watering_frequency' => $validated['watering_frequency'],
        'sunlight' => $validated['sunlight'],
        'soil_type' => $validated['soil_type'],
        'fertilizing' => $validated['fertilizing'],
        'additional_info' => $validated['additional_info'],
    ]);

    // Redirect with a success message
    return redirect()->route('admin.plants')->with('success', 'Plant added successfully!');
}


    public function update(Request $request, $plantId)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
            'watering_frequency' => 'required|string|max:255',
            'sunlight' => 'required|string|max:255',
            'soil_type' => 'required|string|max:255',
            'fertilizing' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the plant by ID
        $plant = Plant::findOrFail($plantId);

        // Update the plant attributes
        $plant->name = $validated['name'];
        $plant->scientific_name = $validated['scientific_name'];
        $plant->watering_frequency = $validated['watering_frequency'];
        $plant->sunlight = $validated['sunlight'];
        $plant->soil_type = $validated['soil_type'];
        $plant->fertilizing = $validated['fertilizing'];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/plants', 'public');
            $plant->image = basename($imagePath);
        }

        // Save the plant
        $plant->save();

        // Redirect or return a response
        return response()->json(['success' => true]);
    }



    public function destroy(Plant $plant)
    {
        $plant->delete();
        return response()->json(['success' => true]);
    }

}
