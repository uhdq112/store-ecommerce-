
 -->
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

Route::get('/admin', function () {
    return view('layouts.admin');
});
*/




define('PAGINATION_COUNT',10);
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
Route::get('/', 'DashboardController@index')->name('admin.dashboard');;// روت خاص ب لوحه التحكم تبع الادمن










    ######################### Begin Languages Route ########################
    Route::group(['prefix' => 'languages'], function () {
      //index علي الداله  LanguagesController راوت يروح علي
        Route::get('/','LanguagesController@index') -> name('admin.languages');//   عرض جميع اللغات المجوده عند الادمن languages  داخل مجلد   admin  داخل مجلد  views  تبع اللغات بمجلدindex روت خاص ب صفحه
      //create علي الداله  LanguagesController راوت يروح علي
        Route::get('create','LanguagesController@create') -> name('admin.languages.create'); //   languages  داخل مجلد   admin  داخل مجلد  views  تبع اللغات بمجلدcreate  روت خاص ب صفحه
      //store علي الداله  LanguagesController راوت يروح علي
        Route::post('store','LanguagesController@store') -> name('admin.languages.store');//    تخزين الي قاعده البيناتlanguages  داخل مجلد   admin  داخل مجلد  views  تبع اللغات store    روت خاص ب صفحه
      //edit علي الداله  LanguagesController راوت يروح علي
        Route::get('edit/{id}','LanguagesController@edit') -> name('admin.languages.edit');//    التعديل في اللغات على قاعده البيناتlanguages  داخل مجلد   admin  داخل مجلد  views  تبع اللغات  EDIT    روت خاص ب صفحه
      //update علي الداله  LanguagesController راوت يروح علي
        Route::post('update/{id}','LanguagesController@update') -> name('admin.languages.update');//   تحديث اللغه علي قاعده البينات languages  داخل مجلد   admin  داخل مجلد  views  تبع اللغات بمجلدiupdate روت خاص ب صفحه
        // الداله تبع الحذف الي يتم التعامل معهdestroy
        //destroy علي الداله  LanguagesController راوت يروح علي
        Route::get('delete/{id}','LanguagesController@destroy') -> name('admin.languages.delete');//    الحذف علي قاعده البيناتlanguages  داخل مجلد   admin  داخل مجلد  views  تبع اللغات بمجلدdelete  روت خاص ب صفحه


    });
    ######################### End Languages Route ########################










    ######################### Begin Main Categoris Routes ########################

    // روت خاص ب الاقسام
    Route::group(['prefix' => 'main_categories'], function () {
      //index علي الداله  MainCategoriesController راوت يروح علي

        Route::get('/','MainCategoriesController@index') -> name('admin.maincategories');//    عرض جميع الاقسام الموجوده عند الادمنmaincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلد index  روت خاص ب صفحه

      //create علي الداله  MainCategoriesController راوت يروح علي

        Route::get('create','MainCategoriesController@create') -> name('admin.maincategories.create'); //   maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلدcreate  روت خاص ب صفحه
      //store علي الداله  MainCategoriesController راوت يروح علي

        Route::post('store','MainCategoriesController@store') -> name('admin.maincategories.store');//    تخزين الي قاعده البينات maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام store    روت خاص ب صفحه
      //edit علي الداله  MainCategoriesController راوت يروح علي

        Route::get('edit/{id}','MainCategoriesController@edit') -> name('admin.maincategories.edit');//    التعديل في اللغات على قاعده البينات maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام  EDIT    روت خاص ب صفحه
      //update علي الداله  MainCategoriesController راوت يروح علي

        Route::post('update/{id}','MainCategoriesController@update') -> name('admin.maincategories.update');//   تحديث اللغه علي قاعده البينات maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلدiupdate روت خاص ب صفحه
        // الداله تبع الحذف الي يتم التعامل معهdestroy
        //destroy علي الداله  MainCategoriesController راوت يروح علي
        Route::get('delete/{id}','MainCategoriesController@destroy') -> name('admin.maincategories.delete');//    الحذف علي قاعده البينات maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلدdelete  روت خاص ب صفحه

        //changeStatus علي الداله  MainCategoriesController راوت يروح علي
        //  maincategories تبع id بتاخذ changeStatus
        Route::get('changeStatus/{id}','MainCategoriesController@changeStatus') -> name('admin.maincategories.status');//    التغيير في الحاله علي قاعده البينات maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلدstatus  روت خاص ب صفحه

    });
    ######################### End  Main Categoris Routes  ########################












    ######################### Begin Sub Categoris Routes ########################

        // روت خاص ب الاقسام

    Route::group(['prefix' => 'sub_categories'], function () {


        Route::get('/','SubCategoriesController@index') -> name('admin.subcategories');


        Route::get('create','SubCategoriesController@create') -> name('admin.subcategories.create');


        Route::post('store','SubCategoriesController@store') -> name('admin.subcategories.store');


        Route::get('edit/{id}','SubCategoriesController@edit') -> name('admin.subcategories.edit');


        Route::post('update/{id}','SubCategoriesController@update') -> name('admin.subcategories.update');


        Route::get('delete/{id}','SubCategoriesController@destroy') -> name('admin.subcategories.delete');


        Route::get('changeStatus/{id}','SubCategoriesController@changeStatus') -> name('admin.subcategories.status');

    });
    ######################### End  Sub Categoris Routes  ########################






    ######################### Begin vendors Routes ########################

        // (التجار)روت خاص ب ب البائعين

    Route::group(['prefix' => 'vendors'], function () {
              // الي تعرض لي الجدول تبع التجارindex علي الداله  VendorsController راوت يروح علي

        Route::get('/','VendorsController@index') -> name('admin.vendors');//    عرض جميع التجار الموجوده عند الادمنvendors  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلد index  روت خاص ب صفحه

      //create علي الداله  VendorsController راوت يروح علي

        Route::get('create','VendorsController@create') -> name('admin.vendors.create');//   vendors   داخل مجلد   admin  داخل مجلد  views  تبع التجار بمجلدcreate  روت خاص ب صفحه
      //store علي الداله  VendorsController راوت يروح علي

        Route::post('store','VendorsController@store') -> name('admin.vendors.store');//    تخزين الي قاعده البينات vendors  داخل مجلد   admin  داخل مجلد  views  تبع التجار store    روت خاص ب صفحه
      //edit علي الداله  VendorsController راوت يروح علي

        Route::get('edit/{id}','VendorsController@edit') -> name('admin.vendors.edit');//    التعديل في التجار على قاعده البينات vendors   داخل مجلد   admin  داخل مجلد  views  تبع التجار  EDIT    روت خاص ب صفحه
      //update علي الداله  VendorsController راوت يروح علي

        Route::post('update/{id}','VendorsController@update') -> name('admin.vendors.update');//   تحديث التجار علي قاعده البينات vendors  داخل مجلد   admin  داخل مجلد  views  تبع التجار بمجلدiupdate روت خاص ب صفحه
            // الداله تبع الحذف الي يتم التعامل معهdestroy
        //destroy علي الداله  VendorsController راوت يروح علي
        Route::get('delete/{id}','VendorsController@destroy') -> name('admin.vendors.delete');//    الحذف علي قاعده البينات vendors  داخل مجلد   admin  داخل مجلد  views  تبع التجار بمجلدdelete  روت خاص ب صفحه


        //changeStatus علي الداله  MainCategoriesController راوت يروح علي
        //  maincategories تبع id بتاخذ changeStatus
        Route::get('changeStatus/{id}','VendorsController@changeStatus') -> name('admin.vendors.status');//    التغيير في الحاله علي قاعده البينات maincategories  داخل مجلد   admin  داخل مجلد  views  تبع الاقسام بمجلدstatus  روت خاص ب صفحه

    });
    ######################### End  vendors Routes  ########################



});






/*
Route::get('/admin', function () {
    return view('admin.dashboard');
});
*/





Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    //getLogin علي الداله  LoginController راوت يروح علي
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    //login علي الداله  LoginController راوت يروح علي
    Route::post('login', 'LoginController@login')->name('admin.login');
});




/*

 ########################### test part routes #####################

//  MainCategory تبع subcateory  داله اختبار لجلب
Route::get('subcategory',function (){

    $mainCategory = \App\Models\MainCategory::find(46); //     معينه الي في قاعده البينات الي رقمه  46 MainCategory  جلب

 return $mainCategory -> subCategories;//  mainCategory يرجع لي الاقسام الفرعيه تبع
});


//  SubCategory تبع maincategory  داله اختبار لجلب

Route::get('maincategory',function (){

  $subcategory = \App\Models\SubCategory::find(1);//    معينه الي في قاعده البينات الي رقمه 1   SubCategory  جلب

  return $subcategory -> mainCategory;//  subcategory يرجع لي القسم الرئيسي  تبع


});
*/
