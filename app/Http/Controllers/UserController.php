<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * returns the login form
     * @return AdminloginForm
     */

    public function login()
    {
        return view('auth.login');
    }


    /**
     * postAdminLogin
     * @return ResponseOfAdminLogin
    */

    public function postLogin(Request $request)
    { 
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $credentials=$request->only('email','password');

        //unauthorized for the users
        $user = (new User())->where('email', $request->email)->first();
        if($user->role->id == 2)
        {
            return back()->with('error','unauthorized');
        }

        if(Auth::attempt($credentials))
        {
            return redirect(route('dashboard'))->with('message','You Are Logged In');      
        }  

        return back()->with('error','Enter correct Email & Password');
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success','You are now log out');
        return redirect(route('login'));
    }

}
