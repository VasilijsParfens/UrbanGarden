<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function create($type)
    {
        // Ensure the type is valid
        $validTypes = ['tip', 'question', 'showcase', 'plant_identification'];

        if (!in_array($type, $validTypes)) {
            abort(404); // Show a 404 error if type is invalid
        }

        return view("posts.forms.$type", compact('type'));
    }

    public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:tip,question,showcase,plant_identification',
        'title' => 'nullable|string|max:255',
        'content' => 'nullable|string|max:5000',
        'image' => 'nullable|image|max:2048',
    ]);

    $imageName = null;

    // Check if image is provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');

        if (!$image->isValid()) {
            return redirect()->back()->withErrors(['image' => 'The image file is not valid.']);
        }

        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

        try {
            // Use putFileAs instead of storeAs
            Storage::disk('public')->putFileAs('images/posts', $image, $imageName);
            \Log::info("Image stored at: storage/app/public/images/posts/{$imageName}");
        } catch (\Exception $e) {
            \Log::error('Image upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['image' => 'Image upload failed. Please try again.']);
        }
    }


    Post::create([
        'user_id' => Auth::id(),
        'type' => $request->type,
        'title' => $request->title,
        'content' => $request->content,
        'image' => $imageName,
    ]);

    return redirect()->route('homepage');
}



    public function showList(Request $request, $type)
{
    // Validate post type
    $validTypes = ['tip', 'question', 'showcase', 'plant_identification'];
    if (!in_array($type, $validTypes)) {
        abort(404);
    }

    // Build the query
    $query = Post::where('type', $type);

    // Search by title or content
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }

    // Sorting
    switch ($request->input('sort_by')) {
        case 'a-z':
            $query->orderBy('title', 'asc');
            break;
        case 'z-a':
            $query->orderBy('title', 'desc');
            break;
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        case 'latest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    // Get the posts
    $posts = $query->get();

    // Return the view
    return view("posts.lists.$type", compact('posts', 'type'));
}

    public function show($id)
    {
        // Fetch the post by ID
        $post = Post::findOrFail($id);

        // Return the view with the post data
        return view('posts.show', compact('post'));
    }

    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    if (Auth::id() !== $post->user_id) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'title' => 'nullable|string|max:255',
        'content' => 'nullable|string|max:5000',
        'image' => 'nullable|image|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');

        if ($image->isValid()) {
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            try {
                Storage::disk('public')->putFileAs('images/posts', $image, $imageName);
                \Log::info("Updated image stored at: storage/app/public/images/posts/{$imageName}");

                // Optionally delete old image
                if ($post->image && Storage::disk('public')->exists('images/posts/' . $post->image)) {
                    Storage::disk('public')->delete('images/posts/' . $post->image);
                }

                $post->image = $imageName;

            } catch (\Exception $e) {
                \Log::error('Image update failed: ' . $e->getMessage());
                return response()->json(['error' => 'Image upload failed.'], 500);
            }
        } else {
            return response()->json(['error' => 'Invalid image file.'], 422);
        }
    }

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return response()->json(['success' => 'Post updated successfully!', 'post' => $post]);
}



    public function destroy($id)
    {
        // Fetch the post by ID
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the post
        $post->delete();

        // Return a JSON response with a success message
        return response()->json(['success' => 'Post deleted successfully!']);
    }

    public function like(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Check if the user has already voted on the post
        $vote = $post->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            if ($vote->is_upvote) {
                return response()->json(['success' => false, 'message' => 'You have already liked this post.']);
            } else {
                // Update the vote to a like
                $vote->update(['is_upvote' => true]);
            }
        } else {
            // Add the like to the post
            $post->votes()->create([
                'user_id' => Auth::id(),
                'is_upvote' => true,
            ]);
        }

        // Update the like and dislike counts
        $likeCount = $post->likes();
        $dislikeCount = $post->dislikes();

        return response()->json(['success' => true, 'likes' => $likeCount, 'dislikes' => $dislikeCount]);
    }

    public function dislike(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Check if the user has already voted on the post
        $vote = $post->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            if (!$vote->is_upvote) {
                return response()->json(['success' => false, 'message' => 'You have already disliked this post.']);
            } else {
                // Update the vote to a dislike
                $vote->update(['is_upvote' => false]);
            }
        } else {
            // Add the dislike to the post
            $post->votes()->create([
                'user_id' => Auth::id(),
                'is_upvote' => false,
            ]);
        }

        // Update the like and dislike counts
        $likeCount = $post->likes();
        $dislikeCount = $post->dislikes();

        return response()->json(['success' => true, 'likes' => $likeCount, 'dislikes' => $dislikeCount]);
    }




}
