<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;

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

//Auth
Route::middleware('isGuest')->group(function(){
    Route::get('/', [TodoController::class, 'login'])->name('login');
    Route::post('/login', [TodoController::class, 'auth'])->name('login.auth');

    Route::post('/register', [TodoController::class, 'inputRegister'])
    ->name('register.post');
});

Route::get('/logout', [TodoController::class, 'logout'])->name('logout');

// todo
    Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::get('/complated', [TodoController::class, 'complated'])->name('complated');
    Route::get('/create', [TodoController::class, 'create'])->name('create');
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');
    Route::patch('/complated/{id}', [TodoController::class, 'updateComplated'])->name('update-complated');
});
