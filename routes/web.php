<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;

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
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/projects/{project:slug}', [ProjectController::class, 'show']);

Route::get('/categories/{category:slug}', [ProjectController::class, 'listByCategory']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/projects/create', [ProjectController::class, 'create']);
    Route::post('/admin/projects/create', [ProjectController::class, 'store']);
    Route::get('/admin/projects/{project:slug}/edit', [ProjectController::class, 'edit']);
    Route::get('/admin/projects/{project:slug}/delete', [ProjectController::class, 'delete']);
    Route::get('/admin', [AdminController::class, 'index']);
});


Route::get('/register', [RegisterUserController::class, 'create']);

Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [SessionController::class, 'store'])
    ->middleware('guest');

Route::get('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth');

Route::fallback(function () {
    // Set a flash message
    session()->flash('error', 'Requested page not found.');

    // Redirect to the home page
    return redirect('/');
});