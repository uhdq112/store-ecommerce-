<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

     //الدخول للكل ليس ادمن فقط
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */








    // داله ادخال في  شاشه اضافه قسم

    public function rules()
    {
        return [
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'category' => 'required|array|min:1',
            'name' => 'required',
            'category_id'  => 'required|exists:main_categories,id',
            'parent_id' =>'required',
            'abbr' => 'required',

            //'category.*.active' => 'required',



        ];
    }
}
