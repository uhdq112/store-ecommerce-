<!-- //  خاص بالموقع web  ملف
//   RouteServiceProvider دخله ملف Providers داخل مجلد app الخاص (بالموقع) في مجلد webنروح نعرف هذا -->
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
//    layout نروح الموقع نشوف الصفحه كامل الخاصه ب layout.sit  نزور الرابط  الخاص بالموقع  الي اسمه
//  layouts داخل مجلد  site زياره استدعاء الصفحه الرئيسيه
Route::get('/', function () {
    return view('layouts.site');
});
*/



//    home + layout نروح الموقع نشوف الصفحه الرئيسيه   front.home   نزور الرابط  الخاص بالموقع  الي اسمه
//   includes داخلfront داخل مجلد  home زياره استدعاء الصفحه الرئيسيه
Route::get('/', function () {
    return view('front.home');
});

