<?php

namespace App\Model\crypt;

use Illuminate\Database\Eloquent\Model;

use App\Model\Helper;

class Des {

    private $key = "lening education";
    /*
    * 加密
    * @param $data 待加密的数据
    * @param $type 加密的算法 cbc ecb
    * @param $key  加密的密钥 长度为8字节
    * @param $iv   加密的初始化向量，当使用cbc模式时需要使用
    */
    function encrypt($data,$type="des-cbc",$key="",$iv=""){
        // 1. 判断type类型，如果不是des-cbc或者des-ecb的话就报错
        if(!in_array($type,["des-cbc","des-ecb","aes-128-cbc","aes-192-cbc","aes-256-cbc"])) {
            throw new \Exception("参数有误");
        }
        if(empty($data)){
            throw new \Exception("参数有误");
        }
        $key || $key = $this->key;
        //
        if($type == "des-ecb") {
            return openssl_encrypt($data, $type, $key);
        }
        $ivlen = openssl_cipher_iv_length($type);
        $iv || $iv = Helper::randStr($ivlen);
        if(strlen($iv) !== $ivlen) {
            throw new \Exception("参数有误");
        }
        return openssl_encrypt($data, $type, $key,0 ,$iv);

    }


    /*
    * 解密
    * @param $data 待解密的数据
    * @param $type 加密的算法 cbc ecb
    * @param $key  加密的密钥 长度为8字节
    * @param $iv   加密的初始化向量，当使用cbc模式时需要使用
    */
    function decrypt($data,$type="des-cbc",$key="",$iv=""){
        // 1. 判断type类型，如果不是des-cbc或者des-ecb的话就报错
        if(!in_array($type,["des-cbc","des-ecb","aes-128-cbc","aes-192-cbc","aes-256-cbc"])) {
            throw new \Exception("参数有误");
        }
        if(empty($data)){
            throw new \Exception("参数有误");
        }
        $key || $key = $this->key;
        //
        if($type == "des-ecb") {
            return openssl_decrypt($data, $type, $key);
        }
        $ivlen = openssl_cipher_iv_length($type);
        $iv || $iv = Helper::randStr($ivlen);
        if(strlen($iv) !== $ivlen) {
            throw new \Exception("参数有误");
        }
        return openssl_decrypt($data, $type, $key,0 ,$iv);
    }
}