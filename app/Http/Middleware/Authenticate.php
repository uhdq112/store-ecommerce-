<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */


//   هل هو مستخدم او ادمنlogin  يحدد الداخل من  Authenticate
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if (Request::is('admin/*')) //     وبعده اي شي  يدخلك الي صفحه الادمن  (admin) اذ زرت اي رابط
                return route('admin.login');
            else
            //مالم  ذا الراوت خاص ب دخول للموقع
                return route('login');

        }
    }
}
