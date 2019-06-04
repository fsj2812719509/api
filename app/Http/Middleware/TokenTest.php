<?php

namespace App\Http\Middleware;

use Closure;

class TokenTest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $token = "jiajia";
    public function handle($request, Closure $next)
    {
        $noncestr = $request->noncestr;
        $timestamp = $request->timestamp;
        $signature = $request->signature;

        if($noncestr && $timestamp && $signature){
            //如果时间没过期 进行签名验证
            $arr = [$noncestr,$timestamp,$this->token];
            sort($arr,SORT_STRING);
            $astr = implode($arr);
            $sign = sha1($astr);
            var_dump($sign);
            if($signature != $sign){
                return response('');
            }
        }
        return $next($request);
    }
}
