<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
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
    return to_route('dashboard');
});

Route::group([
    'middleware' => ['auth', 'verified'],
    'controller' => PostController::class,
    'prefix' => 'post',
    'as' => 'post.',
], function () {

    Route::get('/', 'index')->name('index');
    Route::get('{post}', 'single')->name('single')->scopeBindings();
});

Route::domain('{domain}.localhost')->group(function () {
    Route::get('/', function ($domain) {
        return Post::all();
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
