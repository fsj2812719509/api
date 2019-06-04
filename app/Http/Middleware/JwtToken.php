<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
class JwtToken
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
        $token = $request->header("Authorization");

        if(!$token){
           return response('UNAUTHORIZATION ','401');
        }
        $token = explode(" ",$token);
        $token = $token[1];
        //验证
        try{
            $token = decrypt($token);
            $decoded = JWT::decode($token,env('JWT_TOKEN'),array('HS256'));
            $this->user = $decoded->user;
            return $next($request);
        }catch(\Exception $e){
            return response($e->getMessage(),'401');
        }

    }
}
