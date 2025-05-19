<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle search functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Searching in plants, users, and posts
        $plants = Plant::where('name', 'like', '%' . $query . '%')
                        ->orWhere('scientific_name', 'like', '%' . $query . '%')
                        ->get();

        $users = User::where('name', 'like', '%' . $query . '%')
                     ->orWhere('email', 'like', '%' . $query . '%')
                     ->get();

        $posts = Post::where('title', 'like', '%' . $query . '%')
                     ->orWhere('content', 'like', '%' . $query . '%')
                     ->get();

        // Return search results view with data
        return view('search.results', compact('plants', 'users', 'posts'));
    }
}
