<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguagesController extends Controller
{






    //   التصميم تبع  الغات  languages داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    public function index()
    {
        //  نعرض اللغات الحاليه الموجوده في قاعده البينات
        $languages = Language::select()->paginate(PAGINATION_COUNT);

        return view('admin.languages.index', compact('languages'));
    }






    //    CREAT التصميم (الشكل))    تصميم ادخل فيه اضافه لغه  languages داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي  (شكل )الصفحه داخل مجلد
    public function create()
    {
        return view('admin.languages.create');
    }






    //    تخزن في قاعده البينات INDEX التصميم تبع    languages داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    public function store(LanguageRequest $request)
    {
        try {

            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);

        }



        catch (\Exception $ex)

        {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }









    //   التصميم تبع  التعديل  languages داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    public function edit($id)
    {
        $language = Language::select()->find($id);
        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجوده']);
        }

        return view('admin.languages.edit', compact('language'));
    }








    //     التصميم تبع  التحديث  علي قاعده البينات  languages داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    public function update($id, LanguageRequest $request)
    {

        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit', $id)->with(['error' => 'هذه اللغة غير موجوده']);// editترجع علي
            }

            //  خليه ب0 active مافيش  request لو
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $language->update($request->except('_token'));

            return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }








    //   التصميم تبع  الحذف  languages داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    public function destroy($id)
    {

        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages', $id)->with(['error' => 'هذه اللغة غير موجوده']);//ترجع علي الجدول كامل تبع اللغات
            }
            $language->delete();

            return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
