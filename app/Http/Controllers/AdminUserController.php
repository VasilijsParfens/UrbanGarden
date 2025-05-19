<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        User::create($request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'profile_picture' => 'nullable|url',
            'is_admin' => 'boolean',
            'description' => 'nullable|string',
        ]));
        return redirect()->route('admin.users')->with('success', 'User added successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success' => true]);
    }

}
