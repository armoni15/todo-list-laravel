<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TodoListController;

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
    return view('home');
});

Route::middleware(['guest'])->group(function () {
    // Register
    Route::get('/register', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'store']);

    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [TodoListController::class, 'index']);

    // To do list
    Route::post('/dashboard/todolists', [TodoListController::class, 'store']);
    Route::put('/dashboard/todolists', [TodoListController::class, 'update']);
    Route::delete('/dashboard/todolists', [TodoListController::class, 'destroy']);
    Route::post('/dashboard/todolist/completed', [TodoListController::class, 'completed']);

    // Logout
    Route::post('/logout', [LoginController::class, 'logout']);
});
