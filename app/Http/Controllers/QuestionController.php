<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.singleQuestion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

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
        

        if ($image = $request->file('image')) {
            $destinationPath = public_path('image');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        if ($images = $request->file('images')) {
            $destinationPath = public_path('image');
            $profileImage = date('YmdHis') . "." . $images->getClientOriginalExtension();
            $images->move($destinationPath, $profileImage);
            $input['images'] = "$profileImage";
        }

        $subject=Subject::create([
            'subject' => $request->subject,
            'image' => $request->image,
        ]);

        $subject_category=SubjectCategory::create([
            'topic' => $request->topic,
            'language' =>$request->language,
            'images' => $request->images,
            'subjects_id' => $subject->id, 
        ]);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
