<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        $comment->save();

        return response()->json(['success' => true, 'comment' => $comment->load('user')]);
    }

    public function like(Request $request, Comment $comment)
    {
        $user = Auth::user();
        $vote = CommentVote::firstOrNew([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
        ]);

        $vote->is_upvote = true;
        $vote->save();

        return response()->json(['success' => true, 'message' => 'Comment liked successfully!']);
    }

    public function dislike(Request $request, Comment $comment)
    {
        $user = Auth::user();
        $vote = CommentVote::firstOrNew([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
        ]);

        $vote->is_upvote = false;
        $vote->save();

        return response()->json(['success' => true, 'message' => 'Comment disliked successfully!']);
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() === $comment->user_id) {
            $comment->delete();
            return response()->json(['success' => true, 'message' => 'Comment deleted']);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        if (Auth::id() === $comment->user_id) {
            $comment->content = $request->input('content');
            $comment->save();
            return response()->json(['success' => true, 'comment' => $comment]);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }


    public function show(Comment $comment)
    {
        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'upvotes_count' => $comment->upvotes()->count(),
            'downvotes_count' => $comment->downvotes()->count(),
        ]);
    }
}
