<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/', [PostController::class,'index']);
    Route::get('/posts/{id}', [PostController::class,'show']);
    Route::post('/create',[PostController::class,'store']);
    Route::get('/create', [PostController::class,'create']);
    Route::delete('/posts/{id}', [PostController::class,'destroy']);
    Route::get('/posts/{id}/edit', [PostController::class,'edit']);
    Route::post('/posts/{id}/edit',[PostController::class,'update']);
    
    
    Route::get('/profile/{id}', [ProfileController::class,'show'])->name('profile');
   
    Route::get('/profile/{id}/edit', [ProfileController::class,'edit']);
    Route::post('/profile/{id}/edit', [ProfileController::class,'update'])->name('edit');



    Route::get('/users', [App\Http\Controllers\ProfileController::class, 'users'])->name('users');
    Route::post('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'follwUserRequest'])->name('follow');

    Route::get('/profile/{id}/following', [ProfileController::class,'following'])->name('followings');
    Route::get('/profile/{id}/followers', [ProfileController::class,'followers'])->name('followers');


    
    });


Route::post('/like-post/{id}',[PostController::class,'likePost'])->name('like.post');
Route::post('/unlike-post/{id}',[PostController::class,'unlikePost'])->name('unlike.post');


require __DIR__.'/auth.php';

Auth::routes();


