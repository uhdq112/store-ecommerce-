<?php
// خاص ب الاقسام اللفرعيه

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;

class SubCategory extends Model
{
    protected $table = 'sub_categories';// اسم الجدول في قاعده البينات



    protected $fillable = [
        'translation_lang','parent_id','translation_of', 'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'
    ];





    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }



    public function scopeSelection($query)
    {

        return $query->select('id','parent_id','category_id','translation_lang', 'name', 'slug', 'photo', 'active', 'translation_of');
    }





    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }




    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }











    //  subcategory تبع main category جلب
    // العلاقه هنا ان القسم الفرعي ينتمي الي قسم رئيسي واحد فقط

    //get main category of subcategory
    public  function maincategories(){
        //MainCategory حق جدول {pk }id
        // العلاقه هنا واحد ال واحد belongsTo
        return $this->belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }


}
