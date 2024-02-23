<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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

// Display page to create user
Route::get('/users', [UserController::class, 'create'])->middleware('guest');
// Create new user
Route::post('/users/store', [UserController::class, 'store']);

// Display login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
// Authenticate User login
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


// Display page to create tasks
Route::get('/tasks', [TaskController::class, 'create']);
// Create new task
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
