<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllQuestionController extends Controller
{
    public function index(){
        $subject = Subject::all();
        return view('question.questions',[
            'subjects' => $subject,
        ]);
    }

    public function fetchSubjectCategory($id){
        $subject_category = DB::table("subject_categories")->where("subjects_id",$id)->pluck("topic","id");
        return json_encode($subject_category);
    }


}
