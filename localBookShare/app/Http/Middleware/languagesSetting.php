<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;

class languagesSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            App::setLocale("en");
        } else if(Auth::user()->language == "en"){
            App::setLocale("en");
        } else if(Auth::user()->language == "vi"){
            App::setLocale("vi");
        } else {
            App::setLocale("ja");
        }
        return $next($request);
    }
}
