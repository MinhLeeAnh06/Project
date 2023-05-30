<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }
    public function postLogin(Request $request){
        $credentials = [
            'email'=>$request->email,
            'password'=>$request->password,
            'level'=> [Constant::user_level_host,Constant::user_level_admin] // tk 2 cua kh
        ];
        $remember = $request->remember;
        if(Auth::attempt($credentials,$remember)){
            //return redirect('');
            return redirect()->intended('admin');
        } else{
            return back()->with('notification' , 'ERROR : Email or Password is Wrong');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
