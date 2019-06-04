<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "name"=>"required",
            "password"=>"required"
        ]);
        $data = UserModel::getUserByUserName($request->name)->toArray();
        $password = $data['password'];

        if(Hash::check($request->password,$password)){
            //验证密码成功生成token
            $token = array(
                "iss" => "http://www.api2.com",
                "aud" => "http://www.api2.com",
                "exp" => time()+600,
            );

            unset($data['password']);

            $token = array_merge(["user"=>$data],$token);
            $token = JWT::encode($token,env('JWT_TOKEN'));
            $token = encrypt($token);
            return array_merge($data,['token'=>$token]);
        }
        return response('PLEASE LOGIN IN AGAIN',404);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
