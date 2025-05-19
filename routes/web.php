<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\AdminPlantController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminStatsController;
use App\Http\Middleware\IsAdmin;

// General Controllers
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PlantCommentController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantIdentificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\CommentController;

Route::get('/admin/plants/create', [AdminPlantController::class, 'create'])->name('admin.plants');
Route::post('/admin/plants', [AdminPlantController::class, 'store'])->name('admin.plants.store');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/search', [SearchController::class, 'search'])->name('search');

// Authentication Routes

Route::view('/register', 'user.register')->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::view('/login', 'user.login')->name('login');
Route::post('/login', [UserController::class, 'login']);


Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Plant Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/plants/{plant}/collection', [CollectionController::class, 'store'])->name('user_plant_collection.store');
    Route::delete('/plants/{plant}/collection', [CollectionController::class, 'remove'])->name('user_plant_collection.remove');
});

Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');

// Profile Routes
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware([IsAdmin::class])->group(function () {

    // Admin: Plants
    Route::get('/admin/plants', [AdminPlantController::class, 'index'])->name('admin.plants.index');
    Route::post('/admin/plants', [AdminPlantController::class, 'store'])->name('admin.plants.store');
    Route::put('/admin/plants/{plant}', [AdminPlantController::class, 'update'])->name('admin.plants.update');
    Route::delete('/admin/plants/{plant}', [AdminPlantController::class, 'destroy'])->name('admin.plants.destroy');

    // Admin: Users
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Admin: Posts
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    // Admin: Comments
    Route::get('/admin/post-comments', [AdminCommentController::class, 'indexPostComments'])->name('admin.post_comments');
    Route::get('/admin/plant-comments', [AdminCommentController::class, 'indexPlantComments'])->name('admin.plant_comments');
    Route::delete('/admin/post-comments/{commentId}', [AdminCommentController::class, 'destroyPostComment']);
    Route::delete('/admin/plant-comments/{commentId}', [AdminCommentController::class, 'destroyPlantComment']);

    // Admin: Stats
    Route::get('/admin/stats', [AdminStatsController::class, 'getAdminDashboardStats'])->name('admin.dashboard.stats');

});


// Post Routes
Route::get('/posts/create/{type}', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::get('/posts/lists/{type}', [PostController::class, 'showList'])->name('posts.lists.show');

Route::middleware('auth')->group(function () {
    Route::post('/users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');
});

Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');

Route::delete('/comments/{comment}', [PlantCommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware('auth')->name('post_comments.store');
Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->middleware('auth')->name('comments.like');
Route::post('/comments/{comment}/dislike', [CommentController::class, 'dislike'])->middleware('auth')->name('comments.dislike');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware('auth')->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('post_comments.destroy');


Route::post('/plants/{plantId}/comments', [PlantCommentController::class, 'store'])->middleware('auth')->name('plant_comments.store');
Route::put('/plant-comments/{comment}', [PlantCommentController::class, 'update'])->middleware('auth')->name('plant_comments.update');
Route::delete('/plant-comments/{comment}', [PlantCommentController::class, 'destroy'])->middleware('auth')->name('plant_comments.destroy');


Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('auth')->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');

Route::post('/posts/{id}/like', [PostController::class, 'like'])->middleware('auth')->name('posts.like');
Route::post('/posts/{id}/dislike', [PostController::class, 'dislike'])->middleware('auth')->name('posts.dislike');
