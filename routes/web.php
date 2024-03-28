<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\SearchController;

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
Route::get('/users/show/{id}', [UserController::class, 'show']);
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');


Route::get('/alerts/index', [AlertController::class, 'index'])->name('alerts.index');
Route::get('/alerts/create', [AlertController::class, 'create']);
Route::post('/alerts/store', [AlertController::class, 'store'])->name('alerts.store');
Route::get('/alerts/show/{id}', [AlertController::class, 'show']);



// Display login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
// Authenticate User login
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


Route::group(['prefix'=>'tasks/'], function(){

    Route::get('', [TaskController::class, 'create']);
    Route::post('store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('index', [TaskController::class, 'index']);
    Route::post('update/{id}',[TaskController::class, 'update']);

    Route::group(['prefix'=>'show/{id}/'], function(){

    Route::get('',[TaskController::class, 'show']);
    Route::get('messages',[TaskController::class, 'messages']);
    Route::post('messages/store',[TaskController::class, 'storeMessage'])->name('messages.store');
    Route::get('assignees',[TaskController::class, 'assignees']);
    Route::get('emergency_responders',[TaskController::class, 'assignees']);
    Route::get('volunteers',[TaskController::class, 'assignees']);
    Route::get('request_help', [SearchController::class, 'index'])->name('request_help');
    });    
});



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

