<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    public function register(Request $request)
{
    if (RateLimiter::tooManyAttempts('register:' . $request->ip(), 5)) {
        return response()->json(
            ['error' => 'Too many attempts. Please try again later.'],
            429,
        );
    }

    RateLimiter::hit('register:' . $request->ip(), 60);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Log::info('User Created:', ['user' => $user]);

    auth()->login($user);

    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Registration successful',
            'redirect' => url('/'),
        ]);
    }

    return redirect('/');
}


    public function login(Request $request)
{
    $key = 'login:' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Too many login attempts. Please try again later.'
            ], 429);
        }
        return redirect()
            ->back()
            ->withErrors(['error' => 'Too many login attempts. Please try again in 1 minute.']);
    }

    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        if ($request->expectsJson()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        RateLimiter::clear($key);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'redirect' => url('/'),
            ]);

        }

        return redirect('/');
    }

    RateLimiter::hit($key, 60);

    if ($request->expectsJson()) {
        return response()->json([
            'error' => 'Invalid email or password.'
        ], 401);
    }

    return redirect()
        ->back()
        ->withErrors(['error' => 'Invalid email or password.'])
        ->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
