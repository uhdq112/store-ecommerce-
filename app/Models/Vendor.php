<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// عمليه وراثه
class Vendor extends Model
{
    use Notifiable;

    protected $table = 'vendors';




    protected $fillable = [
        'latitude', 'longitude','name', 'mobile', 'password', 'address', 'email', 'logo', 'category_id', 'active', 'created_at', 'updated_at'
    ];

    protected $hidden = ['category_id', 'password'];





    public function scopeActive($query)
    {

        return $query->where('active', 1);
    }




    // داله وظيفته ترجع مسار الصوره الي في قاعده البينات وتعرضه في الموقع

    public function getLogoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }








    public function scopeSelection($query)
    {
        return $query->select('id', 'category_id','latitude','longitude' ,'active', 'name', 'address', 'email', 'logo', 'mobile');
    }










    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }






    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }




    public function category()
    {
        //العلاقه هنا ان البائع الواحد يقدر  ينتمي الي قسم واحد فقط

        // العلاقه هنا واحد ال واحد belongsTo

        return $this->belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }




}

