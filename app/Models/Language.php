<?php
// خاص بلغات الموقع
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    // اسم الجدول في قاعده البينات
    protected $table = 'languages';
    // اسماء الحقول في جدول الادمن بقاعده البينات
    protected $fillable = [
        'abbr', 'locale','name','direction','active','created_at','updated_at',
    ];



    public function scopeActive($query){
        return $query -> where('active',1);
    }



 // داله وظيفته  الاشياء الي رح تختاره

    public function  scopeSelection($query){

        return $query -> select('id','abbr', 'name', 'direction', 'active');
    }






    public function getActive(){
      return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }

}
