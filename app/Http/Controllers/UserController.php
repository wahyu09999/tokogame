<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function aksiLogin(Request $request){
        $login = $request->validate([
            'username' =>['required'],
            'password' =>['required'],
        ]);
        if(Auth::guard('login')->attempt($login)){
            $request->session()->regenerate();
            return redirect('home');
        }
        return back();
    }

    public function keluar(Request $r)
    {
        Auth::guard('login')->logout();
        $r->session()->regenerateToken();
        return redirect('/');
    }
}
