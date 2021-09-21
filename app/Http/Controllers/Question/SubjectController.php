<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    /**
     * List all the subjects
     * @return request
     *
     */
    public function index()
    {
        
    }
    /**
     * Add New Subjects
     * Edit Subjects 
     */
    public function create(Request $request){
        
        $subject = Subject::all();
        if ($request->ajax()) {
            return DataTables::of($subject)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                        $url=asset('image'.$row->image);
                        return '<img src="'.$url.'" border="0" width="40%" class="img-rounded" align="center" />';
                    })
                    ->addColumn('action', function($row){
                            $btn = '<a href="'.$row->id.'/edit" class="btn btn-outline-primary btn-sm " title="edit"><i class="fas fa-edit"></i></a>';
                            $btn .=' <a class="delete-data btn btn-sm btn-outline-danger" href="javascript:void(0)" data-toggle="modal" data-target="#modelDelete" data-id="'.$row->id.'" title="Delete"><i class="fa fa-trash"></i></a> ';
                           
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
                    
        }
        
        return view('question.subject',[
            'subjects'=>$subject,
        ]);
    }

    /**
     *@param request
     *@return Response
     */

    public function store(Request $request){
        $request->validate([
            'subject' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($image = $request->file('image')) {
            $destinationPath = public_path('image');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $subject=Subject::create([
            'subject' => $request->subject,
            'image' => $request->image,
        ]);

        return back()->with('success','Subject has been created');

    }
    /**
     * @return request
     */
    

    public function edit($id){
    
        $subject = (new Subject())->where('id',$id)->first();
        return view('question.subjectEdit',[
            'subjects' => $subject,
        ]);
    }

    /**
     * @return response
     */

    public function update(Request $request, $id){
        $request->validate([
            'subject' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        if ($image = $request->file('image')) {
            $destinationPath = public_path('image');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        Subject::where('id',$id)->update([
            'subject' => $request->subject,
            'image' =>$request->image,
        ]);
    
        return redirect()->route('singleQuestion.create')->with('success','Subject has been updated');
    }

    /**
     * 
     * @return delete
     */

    public function destroy($id){
        try{
            $subject = (new Subject())->where('id',$id)->first();
            $res = $subject->delete();

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
