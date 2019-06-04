<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected  $table = "users";
    public $timestamps = false;
    protected $fillable = ["name","password"];

    public static function getUserByUserName($name){
        return self::where(['name'=>$name])->first();
    }
}
