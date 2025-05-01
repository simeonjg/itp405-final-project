<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentsController;



// Rendering welcome view and defining route
Route::get('/', function () {
    return view('index');
})->name('welcome.index');

// Registration routes
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

// Login routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Routes protected by auth middleware
Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Search routes
    Route::get('/home', [MovieController::class, 'index'])->name('search.home');
    Route::get('/search', [MovieController::class, 'search'])->name('search.results');
    Route::get('/search/{id}', [MovieController::class, 'show'])->name('search.details');
    
    // Favorites routes
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/add/{id}', [FavoritesController::class, 'add'])->name('favorites.add');
    Route::post('/favorites/delete/{id}', [FavoritesController::class, 'remove'])->name('favorites.remove');
    
    // Comments routes
    Route::post('/comments/post/{id}', [CommentsController::class, 'comment'])->name('search.comment');
    Route::post('/comments/delete/{id}', [CommentsController::class, 'remove'])->name('comments.remove');
    Route::get('comments/edit/{id}', [CommentsController::class, 'edit'])->name('comments.edit');
    Route::post('/comments/update/{id}', [CommentsController::class, 'update'])->name('comments.update');

});




