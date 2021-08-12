<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorCreated;
use DB;

use Illuminate\Support\Str;



class VendorsController extends Controller
{


    //    التصميم تبع  التجار  عرض جميع البائعين الموجوده في الجدول Vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه الشكل داخل مجلد


    public function index()
    {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.vendors.index', compact('vendors'));
    }






    //    CREAT التصميم (الشكل))    تصميم ادخل فيه اضافه مقدم خدمه جديد تاجر بائع جديد   Vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي  (شكل )الصفحه داخل مجلد

    public function create()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        return view('admin.vendors.create', compact('categories'));
    }



    // فديو 28

    //    تخزن او تحفض في قاعده البينات INDEX التصميم تبع    Vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    //   VendorRequest بملف requests داخل مجلد  controller داخل مجلدhttp  داخل app     استدعاء   الفيليديشن   الي داخل مجلد  VendorRequest
    //  الشكل form  الي جايي من request


    public function store(VendorRequest $request)
    {
        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('logo')) { //    vendors  صوره خزنه في جدول  )   logo جايي لك فيه  request اذ
                //Helpers داخل ملف  Helpers  تروح علي الداله الي هي في مجلد uploadImage
                $filePath = uploadImage('vendors', $request->logo);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'logo' => $filePath,
                'password' => $request->password,
                'category_id' => $request->category_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            Notification::send($vendor, new VendorCreated($vendor));//  vendorابعث لل

            return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }









    //   ويعرضه في الصفحه database   التصميم تبع  التعديل علي تاجر يجيب بينات من   Vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد

    public function edit($id)
    {
        try {

            $vendor = Vendor::Selection()->find($id); //  موجود او لا vendor  يشوف هل
            if (!$vendor) // اذ مش موجود
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود او ربما يكون محذوفا ']);

            $categories = MainCategory::where('translation_of', 0)->active()->get(); //   edit يجيب الاقسام الرئيسيه ثم يعرض الصفحه الخاصه ب التعديل

            return view('admin.vendors.edit', compact('vendor', 'categories'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }













    //     التصميم تبع  التحديث  علي قاعده البينات ويسيفه في قاعده البينات  Vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد
    //   VendorRequest بملف requests داخل مجلد  controller داخل مجلدhttp  داخل app     استدعاء   الفيليديشن الي داخل مجلد  VendorRequest

    public function update($id, VendorRequest $request)
    {

        try {

            $vendor = Vendor::Selection()->find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود او ربما يكون محذوفا ']);


            DB::beginTransaction();
            //photo
            if ($request->has('logo') ) {
                 $filePath = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            }


            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

             $data = $request->except('_token', 'id', 'logo', 'password');


            if ($request->has('password') && !is_null($request->  password)) {

                $data['password'] = $request->password;
            }

            Vendor::where('id', $id)
                ->update(
                    $data
                );

            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }






    //   التصميم تبع  الحذف  vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد

    public function destroy($id)
    {

        try {
            $Vendor = Vendor::find($id);
            if (!$Vendor)
                return redirect()->route('admin.Vendors')->with(['error' => 'هذا المتجر غير موجود ']);


            $image = Str::after($Vendor->logo, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image); //delete from folder// الصورmaincategories حذف الصوره من ملف



            $Vendor->delete();// احذف ثم رجع  احذف القسم الرئيسي

            return redirect()->route('admin.Vendors')->with(['success' => 'تم حذف المتجر بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }









    //  /    تخزن في قاعده البينات INDEX التصميم تبع   Vendors داخل ملف  admin داخل ملف views  داله وظيفته تنادي علي الصفحه داخل مجلد

    public function changeStatus($id)
    {
        try {
            $Vendor = Vendor::find($id);
            if (!$Vendor)//   مش موجود رجع لي رساله علي الجدول Vendor اذ كان
                return redirect()->route('admin.Vendors')->with(['error' => 'هذا المتجر غير موجود ']);//   vendorsئ الي هو قروب  admin داخل ملف routes راوت يروح الي مجلد

           $status =  $Vendor -> active  == 0 ? 1 : 0;

           $Vendor -> update(['active' =>$status ]);

            return redirect()->route('admin.Vendors')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}




