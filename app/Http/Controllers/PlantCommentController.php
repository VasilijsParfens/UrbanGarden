<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantComment;
use App\Models\Plant;
use Illuminate\Support\Facades\RateLimiter;

class PlantCommentController extends Controller
{
    public function store(Request $request, $plantId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new PlantComment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->plant_id = $plantId;
        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user') // Load the user relationship
        ]);
    }

    public function update(Request $request, PlantComment $comment)
    {
        // Check if the authenticated user is the owner of the comment or an admin
        if (auth()->user()->id !== $comment->user_id && !auth()->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to edit this comment.'
            ], 403);
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user') // Load the user relationship
        ]);
    }

    public function destroy(PlantComment $comment)
    {
        // Check if the authenticated user is the owner of the comment or an admin
        if (auth()->user()->id !== $comment->user_id && !auth()->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this comment.'
            ], 403);
        }

        // Delete the comment
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully.'
        ]);
    }
}
