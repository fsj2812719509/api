<?php

namespace App\Model\crypt;

use Illuminate\Database\Eloquent\Model;

class Rsa
{

    // 私钥
    private $priv_key;
    // 公钥
    private $pub_key;

    public function __construct($config=[]){

        $res = openssl_pkey_new($config);
        // 得到私钥
        openssl_pkey_export($res, $this->priv_key,null,$config);

        // 得到公钥
        $detail = openssl_pkey_get_details($res);
        $this->pub_key = $detail['key'];

    }

    public function getPriv(){
        return $this->priv_key;
    }

    public function getPub(){
        return $this->pub_key;
    }

    public function setPriv($privkey){
        $this->priv_key = $privkey;
    }

    public function setPub($pubkey){
        $this->pub_key = $pubkey;
    }

    public function encrypt($data,$type="public"){
        if($type == "public"){
            openssl_public_encrypt($data, $crypt, $this->pub_key);
        }else{
            openssl_private_encrypt($data, $crypt, $this->priv_key);
        }
        return base64_encode($crypt);
    }

    public function decrypt($data,$type="public"){
        if($type == "public"){
            openssl_public_decrypt(base64_decode($data), $crypt, $this->pub_key);
        }else{
            openssl_private_decrypt(base64_decode($data), $crypt, $this->priv_key);
        }
        return $crypt;
    }
}