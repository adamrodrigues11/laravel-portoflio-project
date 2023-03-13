<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

// projects routes
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project:slug}', [ProjectController::class, 'show']);
Route::get('/projects/categories/{category:slug}', [ProjectController::class, 'listByCategory']);
Route::get('/projects/tags/{tag:slug}', [ProjectController::class, 'listByTag']);

// admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    // dashboard
    Route::get('/admin', [AdminController::class, 'index']);
    // projects crud
    Route::get('/admin/projects/create', [ProjectController::class, 'create']);
    Route::post('/admin/projects/create', [ProjectController::class, 'store']);
    Route::get('/admin/projects/{project:slug}/edit', [ProjectController::class, 'edit']);
    Route::patch('/admin/projects/{project:slug}/edit', [ProjectController::class, 'update']);
    Route::delete('/admin/projects/{project:slug}/delete', [ProjectController::class, 'destroy']);
    // categories crud
    Route::get('/admin/categories/create', [CategoryController::class, 'create']);
    Route::post('/admin/categories/create', [CategoryController::class, 'store']);
    Route::get('/admin/categories/{category:slug}/edit', [CategoryController::class, 'edit']);
    Route::patch('/admin/categories/{category:slug}/edit', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{category:slug}/delete', [CategoryController::class, 'destroy']);
    // tags crud
    Route::get('/admin/tags/create', [TagController::class, 'create']);
    Route::post('/admin/tags/create', [TagController::class, 'store']);
    Route::get('/admin/tags/{tag:slug}/edit', [TagController::class, 'edit']);
    Route::patch('/admin/tags/{tag:slug}/edit', [TagController::class, 'update']);
    Route::delete('/admin/tags/{tag:slug}/delete', [TagController::class, 'destroy']);
    // users crud
    Route::get('/admin/users/create', [RegisterUserController::class, 'create']); 
        // store method not admin protected as it is same as general registration but with a different redirect for an admin
    Route::get('/admin/users/{user:id}/edit', [RegisterUserController::class, 'edit']);
    Route::patch('/admin/users/{user:id}/edit', [RegisterUserController::class, 'update']);
    Route::delete('/admin/users/{user:id}/delete', [RegisterUserController::class, 'destroy']);
});

// user and session routes
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])
    ->middleware('guest');
Route::get('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth');

// API routes
Route::get('/api/projects', [ProjectController::class, 'getProjectsJSON']);
Route::get('/api/categories', [CategoryController::class, 'getCategoriesJSON']);
Route::get('/api/tags', [TagController::class, 'getTagsJSON']);

// 404 fallback
Route::fallback(function () {
    // Set a flash message
    session()->flash('error', 'Requested page not found.');
    // Redirect to the home page
    return redirect('/');
});