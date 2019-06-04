<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Helper{
    //定义随机字符串生成的方法
    public static function randStr($len=20){
        $string="1234567890poiuytrewqasdfghjklmnbvcxzQWERTYUIOPLKJHGFDSAZXCVBNM";
        $randstr='';
        for($i=0;$i<$len;$i++){
            $index=rand(0,strlen($string)-1);
            $randstr.=$string[$index];
        }
        return $randstr;
    }
}
?>