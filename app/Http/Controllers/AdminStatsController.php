<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plant;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PlantComment;
use App\Models\UserPlantCollection;
use App\Models\Follower;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class AdminStatsController extends Controller
{
    public function getAdminDashboardStats()
    {
        $stats = [
            'users' => [
                'total' => User::count(),
                'admins' => User::where('is_admin', true)->count(),
                'regular_users' => User::where('is_admin', false)->count(),
            ],
            'plants' => [
                'total' => Plant::count(),
                'watering_frequencies' => Plant::select('watering_frequency', DB::raw('count(*) as total'))
                    ->groupBy('watering_frequency')->orderByDesc('total')->get(),
                'sunlight_requirements' => Plant::select('sunlight', DB::raw('count(*) as total'))
                    ->groupBy('sunlight')->orderByDesc('total')->get(),
            ],
            'posts' => [
                'total' => Post::count(),
                'by_type' => Post::select('type', DB::raw('count(*) as total'))
                    ->groupBy('type')->orderByDesc('total')->get(),
                'comments_total' => Comment::count(),
                'comments_average_per_post' => Post::count() > 0
                    ? round(Comment::count() / Post::count(), 2)
                    : 0,
            ],
            'plant_comments' => [
                'total' => PlantComment::count(),
            ],
            'collections' => [
                'by_type' => UserPlantCollection::select('collection_type', DB::raw('count(*) as total'))
                    ->groupBy('collection_type')->orderByDesc('total')->get(),
            ],
            'followers' => [
                'total' => Follower::count(),
                'top_followed_users' => Follower::select('followed_id', DB::raw('count(*) as total'))
                    ->groupBy('followed_id')
                    ->orderByDesc('total')
                    ->take(10)
                    ->with('followed:id,name') // assumes `followedUser` is a relationship on Follower
                    ->get(),
            ],
        ];

        return view('admin.stats', compact('stats'));
    }
}
