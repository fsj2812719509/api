<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "password"=>"required"
        ]);
        $name = decrypt($request->name);
        $password2 = decrypt($request->password);
        $data = UserModel::getUserByUserName($name)->toArray();

        $password = $data['password'];

        //判断密码是否正确
       if(Hash::check($password2,$password)) {
           //密码验证成功，通过jwt获取token
           $token = array(
               "iss" => "www.api.com",
               "aud" => "www.api.com",
               "exp" => time() + 3000
           );
           unset($data['password']);
           $token = array_merge(["user" => $data], $token);
           $token = JWT::encode($token, env("JWT_Token"));
           $token = encrypt($token);
           return array_merge($data,["access_token"=>$token]);
       }
           return response('LOGIN FAILURE',404);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
