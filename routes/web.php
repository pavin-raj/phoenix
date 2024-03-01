<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
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
})->name('home');

// Display page to create user
Route::get('/users', [UserController::class, 'create']);
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

// Open Requests
Route::get('/tasks/index', [TaskController::class, 'index']);


// Log Files - For testing purposes only. 
// Not necessary for project. You can delete these
Route::get('/log/laravel', function(){
    \Log::info('This is my testing log.');
    dd("done");
});
Route::get('/log/mylog', function() {
    \Log::channel('customlog')->info('This is my custom log');
    dd('done');
});



// Route::get('/getcookie', function (){
//     return Cookie::get('task_id');
// }); 

