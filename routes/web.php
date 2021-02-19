<?php

use App\Http\Controllers\PostsController;
use App\Http\Middleware\Honeypot;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/create', [PostsController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');

Route::post('/posts', [PostsController::class, 'store'])
    ->middleware(['auth', Honeypot::class])
    ->name('posts');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';