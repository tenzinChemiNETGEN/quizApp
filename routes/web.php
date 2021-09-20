<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Question\AllQuestionController;
use App\Http\Controllers\Question\SingleQuestionController;
use App\Http\Controllers\Question\SubjectController;
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
  


    //Endpoints for subjects
    // Route::get('subject',[SubjectController::class,'index']);
    Route::get('subject/create',[SubjectController::class,'create'])->name('subject.create');
    Route::post('subject/store',[SubjectController::class,'store'])->name('subject.store');
    Route::get('subject/{id}/edit',[SubjectController::class,'edit'])->name('subject.edit');
    Route::put('subject/{id}',[SubjectController::class, 'update'])->name('subject.update');
    Route::delete('delete/{id}',[SubjectController::class, 'destroy'])->name('subject.destroy');


    //endpoints for SingleQuestion
    // Route::get('question',[SingleQuestionController::class,'index']);
    Route::get('singleQuestion/create',[SingleQuestionController::class,'create']);
    Route::match(array('GET','POST'),'singleQuestion/store',[SingleQuestionController::class,'store'])->name('singlequestion.store');
    
    //endpoints All questions 
    Route::get('question',[AllQuestionController::class,'index']);
    Route::get('question/category/{id}',[AllQuestionController::class,'fetchSubjectCategory'])->name('question.category');

    Route::post('logout',[UserController::class,'logout']);

});








   

