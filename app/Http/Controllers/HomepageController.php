<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Plant;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage', [
            'plants' => Plant::latest()->take(4)->get(),
            'tips' => Post::where('type', 'tip')->latest()->take(4)->get(),
            'questions' => Post::where('type', 'question')->latest()->take(4)->get(),
            'showcases' => Post::where('type', 'showcase')->latest()->take(4)->get(),
            'identifications' => Post::where('type', 'plant_identification')->latest()->take(4)->get(),
        ]);
    }
}
