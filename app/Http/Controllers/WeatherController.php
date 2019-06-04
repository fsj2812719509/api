<?php

namespace App\Http\Controllers;

use App\Model\Http;
use App\Model\WindModel;
use Illuminate\Http\Request;

class WeatherController extends Controller
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
        $request->validate([
            "wind" => "required",
        ]);
        $weaid = $request->wind;

        $data = Http::httpPost("http://api.k780.com/?app=weather.today&weaid=$weaid&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json");
        $json = json_decode($data,true);

        $week = $json['result']['week'];
        $citynm = $json['result']['citynm'];
        $weather = $json['result']['weather'];
        $weather_curr = $json['result']['weather_curr'];
        $wind = $json['result']['wind'];
        $winp = $json['result']['winp'];

        $data = [
            "week"=>$week,
            "citynm"=>$citynm,
            "weather"=>$weather,
            "weather_curr"=>$weather_curr,
            "wind"=>$wind,
            "winp"=>$winp
        ];

        $res = WindModel::insert($data);

        if($res){
            return $data;
        }else{
            response('The query is wrong', 505);
        }

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
