<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccessKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     protected $AUTH_HEADER    = 'secret';
     protected $CONTENT_HEADER = 'Content-Type';

     public function __construct()
     {
       $this->secret = config('api_secret.secret');
     }


    public function handle($request, Closure $next)
    {
      $response = [];
      $secret;
      $type;

      //VALIDO EL TIPO DE DATA
      if($request->hasHeader($this->CONTENT_HEADER)){
        $type = $request->header($this->CONTENT_HEADER);
      }else {
        $response['status']  = 'fails';
        $response['message'] = 'No found Content-Type in header.';
      }

      //VALIDO EL INGRESO DEL TOKEN
      if($request->hasHeader($this->AUTH_HEADER)){
        $secret = $request->header($this->AUTH_HEADER);
      }else {
        $response['status']  = 'fails';
        $response['message'] = 'No found secret in header.';


      }

      
      if($type == "application/json" && $secret  == $this->secret){
        return $next($request);
      }
      else {
        $response['status']  = 'fails';
        $response['message'] = 'Unauthorized Request.';
        return response()->json($response, 401);
      }


    }
}
