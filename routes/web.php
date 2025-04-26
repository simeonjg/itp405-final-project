<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\DenyBlockedUsers;

use App\Models\Artist;
use App\Models\Track;
use App\Models\Genre;
use App\Models\Album;
use App\Mail\NewAlbum;



Route::get('/', function () {
    return view('index');
})->name('welcome.index');


Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
// Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('auth.login'); // named "login" per auth middleware
    // ->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// middleware - functions that run before you hit the controller
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Route::middleware([DenyBlockedUsers::class])->group(function() {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/home', [MovieController::class, 'index'])->name('search.home');
        Route::get('/search', [MovieController::class, 'search'])->name('search.results');
        Route::get('/search/{id}', [MovieController::class, 'show'])->name('search.details');

        Route::post('/tokens', [ProfileController::class, 'createToken'])->name('token.store');
        Route::post('/tokens/{id}', [ProfileController::class, 'revokeToken'])->name('token.destroy');
        Route::view('/blocked', 'blocked')->name('blocked');

    // });
});


Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
Route::get('/albums/new', [AlbumController::class, 'create'])->name('album.create');
Route::post('albums', [AlbumController::class, 'store'])->name('albums.store');

Route::get('/mail', function() {
    Mail::raw('What is your favorite framework?', function ($message) {
        $message->to('david@itp405.com')->subject('Hello, David');
    });
});

Route::get('/new-album', function () {
    $album = Album::find(150);

    Mail::to('david@itp405.com')->queue(new NewAlbum($album));
});

Route::get('/eloquent-playground', function () {
    return view('eloquent-playground', [
        // Querying for many records
        // 'artists' => Artist::all(),
        // 'artists' => Artist::orderBy('Name', 'desc')->get(),
        // 'tracks' => Track::where('UnitPrice', '>', '0.99')->orderBy('Name')->get(),
    
        // Query for a single record
        // 'artist' => Artist::find(4),

        // Belongs-To relationship
        // 'album' => Album::find(152),

        // Has Many relationship
        // 'artist' => Artist::find(152),

        // N + 1 Problem
        'tracks' => Track::where('UnitPrice', '>', 0.99)->orderBy('Name')->limit(20)->get(),
        
        // eager loading / hydration
        'tracks' => Track::with(['genre', 'album'])
            ->where('UnitPrice', '>', 0.99)
            ->orderBy('Name')
            ->limit(20)
            ->get(),

    
    ]);

    // CREATING
    // $genre = new Genre();
    // $genre->Name = 'Hip Hop';
    // $genre->save(); // termination method that will perform the INSERT INTO SQL

    // UPDATING
    // $genre = Genre::find(26);
    // $genre->Name = 'Hip Hop (edited)';
    // $genre->save();

    // DELETING
    // $genre = Genre::find(26);
    // Genre::where('Name', '=', 'Hip Hop (edited)')->delete();
    // $genre->delete();


});