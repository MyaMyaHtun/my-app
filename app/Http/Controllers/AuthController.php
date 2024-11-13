<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    Public function register(Request $request){
        // dd($request->username);
        //validate
        $fields = $request->validate([
            'username' => ['required', 'max:225'],
            'email' => ['required', 'max:225', 'email','unique:users'
        ],
            'password' => ['required', 'min:3', 'confirmed'],

        ]);
        // register
        $user=User::create($fields);
        //login
        Auth::login($user);
        // redirect
        return redirect()->route('posts.index');

    }
    //Login user
    public function login(Request $request){
        // dd("ok");
        $fields = $request->validate([
            'email' => ['required', 'max:225', 'email'],
            'password' => ['required'],

        ]);
        // dd($request);

        //Try to login the user
        if(Auth::attempt($fields, $request->remember)){
            return redirect()->intended('dashboard');
        }else{
            return back()->withErrors(['failed'=>'The provided credentials do not match our records.']);
        }
    }
    //Logout user
    public function logout(Request $request){
        // dd("ok");
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
