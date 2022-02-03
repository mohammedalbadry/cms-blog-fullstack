<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
class SettingCheck
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

        if(Setting::first()->status == "close"){
            return redirect('close'); 
        }

        return $next($request);
    }
}
