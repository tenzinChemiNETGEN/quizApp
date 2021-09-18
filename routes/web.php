<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Question\SelectSubject;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Admin login 
 */


Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('post-login',[UserController::class,'postLogin'])->name('login.post');


/**
 * Admin Controller
 */

Route::group(['middleware' => ['auth','isAdmin']], function(){

    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::resource('singleQuestion',QuestionController::class);
  
    
    Route::post('logout',[UserController::class,'logout']);

});








   

