<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AllQuestionController extends Controller
{
    /**
     * Shows the subjects
     * @return request
     * 
     */
    public function index(){
        $subject = Subject::all();
        return view('question.questions',[
            'subjects' => $subject,
        ]);
    }
    /**
     * Shows the subject topics
     * @return response
     */

    public function getSubjectCategory(Request $request){
        $subjectID = $request->post('subjectID');
        echo $subjectCategory = DB::table('subject_categories')->where('subjects_id',$subjectID)->get();

        $html='<option value="">Select Subject</option>';
        foreach($subjectCategory as $list){
            $html.='<option value="'.$list->id.'">'.$list->topic.'</option>';
        }
        echo $html;
    }

    /**
     * returns the filter questions 
     */
    public function getQuestion(Request $request){
     

        $questions = new Question;
        if($request->category != null){
            $questions = $questions->where('subject_categoryId', $request->category);
        }
        else{
            $questions = $questions->select('*');
        }

        $questions = $questions->get();
        
        return DataTables::of($questions)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="question/'.$row->id.'/edit" class="btn btn-outline-primary btn-sm " title="edit"><i class="fas fa-edit"></i></a>';
                        $btn .=' <a class="delete-data btn btn-sm btn-outline-danger" href="javascript:void(0)" data-toggle="modal" data-target="#modelDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash"></i></a> ';
                        
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
                
    }

    /**
     * edit questions
     * @return request
     */
    public function edit($id){
        $question = (new Question())->where('id',$id)->first();
        return view('question.questionEdit',[
            'question' => $question,
        ]);
    }

    public function update(Request $request, $id){
      
        $request->validate([
            'question' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'correct_answer' => 'required',
            'description' => 'required',
            'difficulty_level' => 'required',
        ]);
        Question::where('id',$id)->update([
            'question' => $request->question,
            'answer1' =>$request->answer1,
            'answer2' =>$request->answer2,
            'answer3' =>$request->answer3,
            'answer4' =>$request->answer4,
            'correct_answer' => $request->correct_answer,
            'description' => $request->description,
            'difficulty_level' => $request->difficulty_level
        ]);

        return redirect()->route('question')->with('success','Question has been updated');
    }

    public function destroy($id){
        try{
            $question = (new Question())->where('id',$id)->first();
            $res = $question->delete();

            if($res == true){
                return [
                    'success' => true,
                    'message' => 'Subject Deleted !'
                ];
            }
            else{
                return [
                    'success' => false,
                    'message' => 'Something Went Wrong, Try Again !'
                ];
            }
        }
        catch(Exception $e){
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

    }
    





}
