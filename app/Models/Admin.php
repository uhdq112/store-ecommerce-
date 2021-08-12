<?php
// خاص ب لادمن
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
// اسم الجدول في قاعده البينات
    protected $table = 'admins';
// اسماء الحقول في جدول الادمن بقاعده البينات
    protected $fillable = [
        'name', 'email','photo','password','created_at','updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
