<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class SingleQuestionController extends Controller
{
    /**
     * View Single Questions
     * @return request
     */
    public function index()
    {
        // $subject = Subject::all();
        // // $subject_category = SubjectCategory::all();
        // // $question = Question::all();
        
        // return view('question.questions',[
        //     'subjects' => $subject,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = Subject::all();
        return view('question.singleQuestion',[
            'subjects' => $subject,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->subject);
        $request->validate([
            'subject' => 'required',
            'topic' => 'required',
            'language' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

            'question' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'correct_answer' => 'required',
            'description' => 'required',
            'difficulty_level' => 'required',
        ]);
 
        if ($images = $request->file('images')) {
            $destinationPath = public_path('image');
            $profileImage = date('YmdHis') . "." . $images->getClientOriginalExtension();
            $images->move($destinationPath, $profileImage);
            $input['images'] = "$profileImage";
        }
        $subject_category = (new SubjectCategory())->where('topic', $request->topic)->where('language', $request->language)->where('subjects_id', $request->subject)->first();

        if($subject_category == null){
            $subject_category = new SubjectCategory;
            $subject_category->topic = $request->topic;
            $subject_category->language = $request->language; 
            $subject_category->images = $request->images; 
            $subject_category->subjects_id = $request->subject; 
            $subject_category->save();
        }

        Question::create([
            'question' => $request->question,
            'answer1' => $request->answer1,
            'answer2' => $request->answer2,
            'answer3' => $request->answer3,
            'answer4' => $request->answer4,
            'correct_answer' => $request->correct_answer,
            'description' => $request->description,
            'difficulty_level' => $request->difficulty_level,
            'subject_categoryId' => $subject_category->id,
        ]);

        return back()->with('success','Question has been uploaded');
        // return redirect()->route('singleQuestion.show')->with('success','one question has been created');
    }

    /**
     * @return EditView
     */



}
