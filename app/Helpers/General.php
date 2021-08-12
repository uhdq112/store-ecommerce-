<?php

use Illuminate\Support\Facades\Config;


//     Language الي هو ملف Models  داخل مجلد app داله لجلب اللغات المفعله من مجدلد

function get_languages(){

    return \App\Models\Language::active() -> Selection() -> get();
}




//   maincategories تبع INDEX  معرفه هذه اللغه في
function get_default_lang(){
  return   Config::get('app.locale');
}






// SubCategory الي هو ملف Models  داخل مجلد app داله لجلب الاقسام الفرعيه المفعله من مجدلد

function get_subcategories(){

    return \App\Models\SubCategory::active() -> Selection() -> get();
}


function  get_default_subcategories(){
  return   Config::get('app.locale');
}







// داله ترفع الصور وتحفض في قاعده البينات

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}








function uploadVideo($folder, $video)
{
    $video->store('/', $folder);
    $filename = $video->hashName();
    $path = 'video/' . $folder . '/' . $filename;
    return $path;
}


