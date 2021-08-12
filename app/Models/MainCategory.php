<?php
// خاص  ب الاقسام الرئيسيه في الموقع تبع لادمن مش تبع المزود
namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;


class MainCategory extends Model
{
    // اسم الجدول في قاعده البينات

    protected $table = 'main_categories';

    // اسماء الحقول في جدول الادمن بقاعده البينات
    protected $fillable = [
        'translation_lang', 'translation_of', 'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'
    ];

    // فديو 40

    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }



    // داله وظيفته هل هذا القسم فعال او مش فعال
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }




    public function scopeSelection($query)
    {

        return $query->select('id', 'translation_lang', 'name', 'slug', 'photo', 'active', 'translation_of');
    }


    // داله وظيفته ترجع الصوره الي في قاعده البينات وتعرضه في الموقع


    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }





    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }




    public function scopeDefaultCategory($query){
        return  $query -> where('translation_of',0);
    }









    // categories  ترجع لي جميع الترجمات تبع
    // get all translation categories
    public function categories()
    {
        //العلاقه هنا ان القسم الرئيسي يحتوي على ترجمه واحده او اكثر

        //   {fk} translation_of ترجع
      // العلاقه متعدد hasMany

        return $this->hasMany(self::class, 'translation_of');
    }














// العلاقه هنا ان القسم الرئيسي قد يكون له قسم فرعي واهد او اكثر
//    معين main_categorie ل subCategories  علاقه جلب جميع

    public  function subCategories(){
        //   {fk}category_idترجع
        //SubCategory حق جدول {pk }id
      // العلاقه متعدد hasMany
        return $this -> hasMany(SubCategory::class,'category_id','id');
    }









    //     واحد او اكثر vendorالعلاقه هنا    ان القسم الواحد قد يكون له
    //    معين main_categorie ل vendors  علاقه جلب جميع

    public function vendors(){
        // {fk} category_id ترجع

       //     Vendor حق جدول {pk }id
       // العلاقه متعدد hasMany

        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }



}




