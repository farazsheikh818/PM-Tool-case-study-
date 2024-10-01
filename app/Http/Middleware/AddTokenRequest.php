<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTokenRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
   
        $token = null;    
   
        foreach(explode(';',  $request->headers->get('cookie')) as $tk){
            if(isset(explode('=', $tk)[0]) && explode('=', $tk)[0] == "token"){
                    $token=explode('=', $tk)[1];
                    break;
            }
        }   
        // If a token is found, set it in the Authorization header
       
        if ($token) {
            
            $request->headers->set('Authorization', 'Bearer ' . $token);
        // dd($token);
        }
      
       
        return $next($request);
    }
}
