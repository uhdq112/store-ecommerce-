<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;

class SubCategoriesController   extends Controller
{






    public function index()
    {
        $default_lang = get_default_subcategories();
        $categories = SubCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();

        return view('admin.subcategories.index',compact('categories'));
    }




    public function create()
    {
        return view('admin.subcategories.create');
    }

}










