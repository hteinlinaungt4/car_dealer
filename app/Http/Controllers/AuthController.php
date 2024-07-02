<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }

    public function login(){

        return view('login');
    }

    function dashboard(){
        if(Auth::user()->role == 'admin'){

            return redirect()->route('admin.dashboard');
        }else{

            return redirect()->route('user.dashboard');
        }
    }
}
