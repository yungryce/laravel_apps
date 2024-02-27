<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
// use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/user', function (Request $request) {
//     return view('auth.forgot-password');
// });

Route::middleware('auth')->group(function () {
    Route::get('user', function (Request $request) {
        return dd(get_class_methods($request->user()));
        // return $request->user();
    });
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


// Route::match(['get', 'post'], [ContactController::class, 'contact']);
// routes/web.php
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Route::get('/users/{user}', function(User $user) {
//     return $user->email;
// });

require __DIR__.'/auth.php';
