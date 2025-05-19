<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // Load followers and following counts
        $user->loadCount(['followers', 'following']);

        // Load the plant collections
        $collections = [
            'plantsIHave' => $user->plantCollections()->with('plant')->where('collection_type', 'have')->get(),
            'plantsIHad' => $user->plantCollections()->with('plant')->where('collection_type', 'had')->get(),
            'plantsIWant' => $user->plantCollections()->with('plant')->where('collection_type', 'want')->get(),
        ];

        // Load the user's posts
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('profile.show', [
            'user' => $user,
            'collections' => $collections,
            'posts' => $posts,
        ]);
    }

    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = $request->input('name');

    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists
        if ($user->profile_picture) {
            $oldPath = 'storage/images/assigned_profile_pictures/' . $user->profile_picture;
            if (file_exists(public_path($oldPath))) {
                unlink(public_path($oldPath));
            }
        }

        // Store the new profile picture
        $path = $request->file('profile_picture')->store('images/assigned_profile_pictures', 'public');
        $user->profile_picture = basename($path);
    }

    $user->save();

    return redirect()->route('profile.show', $user)->with('success', 'Profile updated successfully.');
}

}
