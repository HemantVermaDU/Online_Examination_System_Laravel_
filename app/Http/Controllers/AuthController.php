<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\PasswordReset;
use Mail;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function loadRegister()
    {
      if(Auth::user() && Auth::user()->is_admin == 1){
        return redirect('/admin/dashboard');
          }
          else if(Auth::user() && Auth::user()->is_admin == 0){
            return redirect('/dashboard');
          }
      return view('register');
    }

    public function studentRegister(Request $request)
    {
          
        $request->validate([
            'name'=>'string|required|min:2',
            'email'=>'string|email|required|max:100|unique:users',
            'password'=>'string|required|confirmed|min:5'
        ]);

          $user = new User;
          $user->name =$request->name;
          $user->email =$request->email;
          $user->password = Hash::make($request->password);
          $user->save();

          return back()->with('success','Your Resistration has been successfully');
    }

    public function loadlogin()
    {
      if(Auth::user() && Auth::user()->is_admin == 1){
    return redirect('/admin/dashboard');
      }
      else if(Auth::user() && Auth::user()->is_admin == 0){
        return redirect('/dashboard');
      }
     return view('login');
    }

    public function userLogin(Request $request)
    {
      $request->validate([
        'email'=>'string|required|email',
        'password'=>'string|required'
      ]);

      $userCredential = $request->only('email','password');
      if(Auth::attempt($userCredential)){
    
        if(Auth::user()->is_admin == 1){
          return redirect('/admin/dashboard');

        }else{
          return redirect('/dashboard');
        }

      }
      else{
        return back()->with('error','Username & Password is incorrect');
      }
    }

    public function loadDashboard(){
             return view('student.dashboard');
    }

    public function adminDashboard(){
      $subjects = Subject::all();
      return view('admin.dashboard',compact('subjects'));
}

public function logout(Request $request){
     $request->session()->flush();
     Auth::logout();
     return redirect('/');
}

public function forgetpasswordLoad()
{
  return view('forget-password');
}

public function forgetPassword(Request $request)
{
  try{
     
   $user = User::where('email',$request->email)->get();

   if(count($user) > 0){

    $token = Str::random(40);
    $domain = URL::to('/');
    $url= $domain.'/reset-password?token='.$token;

    $data['url'] = $url;
    $data['email']=$request->email;
    $data['title']='password Reset';
    $data['body']='Please click on the below link to reset your password.';

    Mail::send('forgetPasswordMail',['data'=>$data],function($message) use ($data){
      $message->to($data['email'])->subject($data['title']);
    });




   }
   else{
    return back()->with('error','Email is not exists');
   }
  }
  catch(\Exception $e){
     return back()->with('error',$e->getMessage());
  }
}
}
