<?php

namespace App\Http\Controllers;

use App\Model\ArticleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
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
        $all = $request->all();
        $title = $all['title'];
        $content = $all['content'];
        $uid = 1;
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
                $data = [
                    "title"=>$title,
                    "content"=>$content,
                    "uid"=>1
                ];
                if($re){
                    //完成入库操作
                    $res = ArticleModel::insert($data);
                    if($res){
                        return 404;
                    }
                }
            }
        }
       /* $title = $data['title'];
        $content = $data['content'];*/


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
