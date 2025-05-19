<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\PlantComment;

class AdminCommentController extends Controller
{
    public function indexPostComments()
    {
        $comments = Comment::with('user', 'post')->get();
        return view('admin.post_comments', compact('comments'));
    }

    public function indexPlantComments()
    {
        $comments = PlantComment::with('user', 'plant')->get();
        return view('admin.plant_comments', compact('comments'));
    }

    public function destroyPostComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return response()->json(['success' => true]);
    }

    public function destroyPlantComment($commentId)
    {
        $comment = PlantComment::findOrFail($commentId);
        $comment->delete();
        return response()->json(['success' => true]);
    }
}
