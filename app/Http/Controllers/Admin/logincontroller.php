<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function  getLogin(){

        return view('admin.auth.login');
    }


    public function save(){

        $admin = new App\Models\Admin();
        $admin -> name ="zeyad";
        $admin -> email ="uhdq112@gmail.com";
        $admin -> password = bcrypt("01238450");
        $admin -> save();

    }

    public function login(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;// تذكرني

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {//  الايميل والباسورد اذ حصله يدخلك الي لوحه التحكم حق الادمن  admin  دور لي في قاعده البينات في الجدول الي اسمه
            return redirect() -> route('admin.dashboard');
        }

        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
}
