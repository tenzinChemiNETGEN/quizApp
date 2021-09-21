<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelQuestionController extends Controller
{
    /**
     * Excel Questions view
     */
    public function index(){
        return view('question.import');
    }

    public function store(Request $request){
        // dd($request);
        Excel::import(new QuestionImport(),$request->file('questionFile'));
        return 'Success';
    }
    


}
