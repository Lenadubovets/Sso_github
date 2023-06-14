<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logingit', function () {
    return Socialite::driver('github')->redirect();
})->name('logingit');

Route::get('/login/callback', function () {
    $user = Socialite::driver('github')->user();
    dd($user);
    // Handle the authenticated user
    // e.g., create a new user or log in an existing user
    // based on the received user information
    
    // Redirect the user to the desired location
    return redirect('/dashboard');
})->name('login.callback');

