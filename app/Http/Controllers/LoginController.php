<?php

namespace App\Http\Controllers;
use App\Model\ArticleModel;
use App\Model\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录界面
    public function loginList(){
        return view('login.login');
    }
    //调登录接口
    public function login(Request $request){
        $all = $request->all();
        $name = encrypt($all['name']);
        $password = encrypt($all['password']);

        $noncestr ="fushijia";
        $token = "fushijia";
        $timeatamp = time();

        $arr = [$noncestr,$timeatamp,$token];
        sort($arr,SORT_STRING);
        $ast = implode($arr);
        $sig = sha1($ast);


        $data = [
            "name"=>$name,
            "password"=>$password,
        ];

        $url = Http::httpPost("http://www.api2.com/api/logintest?signature=$sig&noncestr=$noncestr&timestamp=$timeatamp",$data);
        $token = json_decode($url,true);
        $toekn2 = $token['access_token'];
        session(['token'=>$token]);
        if($token){
           return $toekn2;
        }else{
            echo 404;
        }
    }
    public function test(){
        return view('login.logintest');
    }




    //注册页面
    public function registerList(){
         return view('login.register');
    }
    //调用注册接口
    public function register(Request $request){
        $all = $request->all();
        $name = $all['name'];
        $email = $all['email'];
        $password = $all['password'];
        $data = [
            "name"=>$name,
            "email"=>$email,
            "password"=>$password
        ];
        $url = Http::httpPost('http://www.api2.com/api/register',$data);
        $url = json_decode($url,true);
        if($url == 200){
            return '1';
        }else{
            return '2';
        }

    }


    //查询天气页面
    public function windlist(){
        return view('login.wind');
    }
    //天气接口
    public function wind(Request $request){
        $all =  $request->all();
        $wind = $all['wind'];
        $data = [
            "wind"=>$wind
        ];

        $noncestr ="fushijia";
        $token = "fushijia";
        $timeatamp = time();

        $arr = [$noncestr,$timeatamp,$token];
        sort($arr,SORT_STRING);
        $ast = implode($arr);
        $sig = sha1($ast);

        $url = Http::httpPost("http://www.api2.com/index.php/api/weatcher?noncestr=$noncestr&timestamp=$timeatamp&signature=$sig",$data);
        $json = json_decode($url,true);
        if($json){
            return $json;
        }else{
            echo '404';
        }


    }

    //文件上传页面
    public function uploadView(){
        return view('Upload.do');
    }
    //调用文件上传的接口
    public function upload(Request $request)
    {


    }


}
