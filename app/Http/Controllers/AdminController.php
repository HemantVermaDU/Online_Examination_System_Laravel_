<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;

class AdminController extends Controller
{
    //add subject
    public function addSubject(Request $request)
    {
    try{  
        Subject::insert([
            'subject' => $request->subject
        ]);

        return response()->json(['success'=>true,'msg'=>'Subject Added Successfully']);
    }
    catch(\Exception $e){
     return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

    };
    }
   

    //edit subject
    public function editSubject(Request $request)
    {
    try{  
         
        $subject = Subject::find($request->id);
        $subject->subject = $request->subject;
        $subject->save();

        return response()->json(['success'=>true,'msg'=>'Subject updated Successfully']);
    }
    catch(\Exception $e){
     return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

    };
    }


 //delete subject
    public function deleteSubject(Request $request)
    {
    try{  
         
        Subject::where('id',$request->id)->delete();

        return response()->json(['success'=>true,'msg'=>'Subject delete Successfully']);
    }
    catch(\Exception $e){
     return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

    };
    }


    //Exam Dashboard 
    public function examDashboard()
    {  
        $subjects = Subject::all();
        $exams = Exam::with('subjects')->get();
      return view('admin.exam-dashboard',['subjects'=>$subjects,'exams'=>$exams]);
    }

    //Add Exams
    public function addExam(Request $request)
    {  
        try{  
         Exam::insert([
        'exam_name' => $request->exam_name,
        'subject_id' => $request->subject_id,
        'date' => $request->date,
        'time' => $request->time,
         ]);
            return response()->json(['success'=>true,'msg'=>'Exam added Successfully']);
        }
        catch(\Exception $e){
         return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
    
        }; 
    }
}
