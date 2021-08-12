<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;

class MainCategoriesController extends Controller
{




    //    التصميم تبع  الاقسام  عرض جميع الاقسام الموجوده في الجدول MainCategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه الشكل داخل مجلد


    public function index()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();

        return view('admin.maincategories.index', compact('categories'));
    }












    //    CREAT التصميم (الشكل))    تصميم ادخل فيه اضافه قسم  maincategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي  (شكل )الصفحه داخل مجلد

    public function create()
    {
        return view('admin.maincategories.create');
    }








    //    تخزن في قاعده البينات INDEX التصميم تبع    maincategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد


    public function store(MainCategoryRequest $request)
    {
// فديو 17 يشرح
        try {
            //return $request;

            $main_categories = collect($request->category);

            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_category = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('maincategories', $request->photo);
            }

            DB::beginTransaction();

            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath
            ]);

            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($categories) && $categories->count()) {

                $categories_arr = [];
                foreach ($categories as $category) {
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath
                    ];
                }

                MainCategory::insert($categories_arr);
            }

            DB::commit();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }












    //   ويعرضه في الصفحه database   التصميم تبع  التعديل يجيب بينات من   maincategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد

    public function edit($mainCat_id)
    {
        //get specific categories and its translations
        $mainCategory = MainCategory::with('categories')
        ->selection()
        ->find($mainCat_id);


        // اذ كان مش موجود القسم يرجع هذا القسم مش موجود
        if (!$mainCategory)
        return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.maincategories.edit', compact('mainCategory')); //  edit الي هو ملف maincategories داخل مجلد  admin مالم يذهب يعرض  صفحه التعديل الي هي في مجلد
    }













    //     التصميم تبع  التحديث  علي قاعده البينات ويسيفه في قاعده البينات  maincategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد

    public function update($mainCat_id, MainCategoryRequest $request)
    {


        try {
            $main_category = MainCategory::find($mainCat_id);

            if (!$main_category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $category = array_values($request->category) [0];

            if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


            MainCategory::where('id', $mainCat_id)
                ->update([
                    'name' => $category['name'],
                    'active' => $request->active,
                ]);

            // save image
           // فديو21
            if ($request->has('photo')) {
                $filePath = uploadImage('maincategories', $request->photo);
                MainCategory::where('id', $mainCat_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.maincategories')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }













    //   التصميم تبع  الحذف  maincategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد


    public function destroy($id)
    {

        try {
            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $maincategory->vendors();
            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.maincategories')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);
            }

            $image = Str::after($maincategory->photo, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image); //delete from folder// الصورmaincategories حذف الصوره من ملف

            $maincategory-> maincategories() -> delete(); //امسح الترجمات ثم الي تحته

            $maincategory->delete();// احذف ثم رجع  احذف القسم الرئيسي

            return redirect()->route('admin.maincategories')->with(['success' => 'تم حذف القسم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }














    //  /    تخزن في قاعده البينات INDEX التصميم تبع   maincategories داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد

    public function changeStatus($id)
    {
        try {
            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $maincategory -> active  == 0 ? 1 : 0;

           $maincategory -> update(['active' =>$status ]);

            return redirect()->route('admin.maincategories')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}




