<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Question\AllQuestionController;
use App\Http\Controllers\Question\ExcelQuestionController;
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
  
    //endpoints for subjects
    Route::get('subject/create',[SubjectController::class,'create'])->name('subject.create');
    Route::post('subject/store',[SubjectController::class,'store'])->name('subject.store');
    Route::get('subject/{id}/edit',[SubjectController::class,'edit'])->name('subject.edit');
    Route::put('subject/{id}',[SubjectController::class, 'update'])->name('subject.update');
    Route::delete('delete/{id}',[SubjectController::class, 'destroy'])->name('subject.destroy');


    //endpoints for Adding Single Question
    // Route::get('question',[SingleQuestionController::class,'index']);
    Route::get('singleQuestion/create',[SingleQuestionController::class,'create']);
    Route::match(array('GET','POST'),'singleQuestion/store',[SingleQuestionController::class,'store'])->name('singlequestion.store');
    
    //endpoints for excel import Questions
    Route::get('excel-question',[ExcelQuestionController::class,'index']);
    Route::post('excelquestion/store',[ExcelQuestionController::class,'store'])->name('excel.store');



    
    //endpoints for All questions CRUD operation
    Route::get('question',[AllQuestionController::class,'index'])->name('question');
    Route::post('getSubjectCategory',[AllQuestionController::class,'getSubjectCategory']);
    Route::get('getQuestion',[AllQuestionController::class,'getQuestion'])->name('get.question');
    Route::get('question/{id}/edit',[AllQuestionController::class,'edit']);
    Route::put('question/{id}',[AllQuestionController::class,'update'])->name('question.update');
    Route::delete('questionDelete/{id}',[AllQuestionController::class, 'destroy'])->name('question.destroy');


    Route::post('logout',[UserController::class,'logout']);

});








   

