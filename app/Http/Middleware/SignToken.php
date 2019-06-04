<?php

namespace App\Http\Middleware;

use Closure;

class SignToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $token = "fushijia";
    public function handle($request, Closure $next)
    {
        $noncestr = $request->noncestr;
        $timestamp = $request->timestamp;
        $signature = $request->signature;

        if($noncestr && $timestamp && $signature){
            //如果时间没过期，则进行签名验证
            $arr = [$noncestr,$timestamp,$this->token];
            sort($arr,SORT_STRING);
            $astr = implode($arr);
            $sing = sha1($astr);
            if($signature != $sing){
                return response('UNSUPPORTED MEDIA TYPE',415);
            }
        }else{
            return response('LLLEGAL SOURCES',405);
        }


        return $next($request);
    }

}
