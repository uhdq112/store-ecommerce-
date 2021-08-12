<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//ترجع لي الشكل تبع الدخول
class DashboardController extends Controller
{

    // التصميم تبع لوحه التحكم admin بملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    public function index(){
         return view('admin.dashboard');
    }
}
