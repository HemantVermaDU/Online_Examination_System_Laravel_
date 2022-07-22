<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loadRegister()
    {
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
}
