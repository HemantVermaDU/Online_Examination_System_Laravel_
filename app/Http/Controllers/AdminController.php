<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class AdminController extends Controller
{
    //
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
}
