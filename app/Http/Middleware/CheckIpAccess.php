<?php

namespace App\Http\Middleware;

use Closure;
use  App\Models\AccesosIp;

class CheckIpAccess
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
      $ip = request()->ip();
      $acceso = AccesosIp::where('ip',$ip)->first();

      if ($acceso){
        if($acceso->status == false){
          return redirect()->route('acceso');
        }else{
          return $next($request);
        }
      }
      //caso contrario seguimos con petición
      return $next($request);
    }
}
