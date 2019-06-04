<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class ArticleModel extends Model
{
    //
    protected $table = 'article';
    public function Upload(Request $request)
    {
        //
        $data = $request->all();


        //文件上传
        $file = $request->file('image');


        //允许文件上传的文件类型
        $allow = ['jpg','png','jpeg','gif'];
        if($request->hasFile('image') && $file->isValid()){
            //获取文件后缀名
            $ext = $file->getClientOriginalExtension();
            if(in_array($ext,$allow)){
                //获取当前文件的位置
                $path = $file->getRealPath();
                //生成新的文件名
                $newfilename = date("Y-m-d")."/".$request->book_name.mt_rand(100,999).".".$ext;
                $re = Storage::disk('public')->put($newfilename,file_get_contents($path));

                if($re){
                    //完成入库操作
                    $res = ArticleModel::insert($data);
                    if($res){
                        return 200;
                    }
                }
            }else{
                exit("上传失败");
            }
        }
        /* $title = $data['title'];
         $content = $data['content'];*/


    }
}
