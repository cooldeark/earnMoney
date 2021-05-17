<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stockController extends Controller
{
    public function calculator(){
        return view('stock.calculator');
        
        // $myResult=$this->getStock();
        
    }

    public function calculatorPost(Request $req){
        $stockResult=json_decode($this->getStock($req->stockNumber));
        $stockResult=(int)$stockResult->realtime->latest_trade_price;
        // dd($stockResult);
        $fullPrice=$stockResult*1000;
        $transaltePrice=(int)round($fullPrice*0.001425);//round四捨五入，然後再加上int是為了讓他完全整數不留浮點數
        $sellRatePrice=(int)round($fullPrice*0.003);
        $lookMore=$fullPrice+($transaltePrice*2)+$sellRatePrice;//買入賣出都有成本所以手續費要兩次
        //這裡有幾點需要處理，每個股價區間的上下不一樣，9.9以內是一個區間0.01加，10以上是0.5，100以上是另一個區間
        $myResultArr=array(
            'eachPrice'=>$stockResult,
            'fullPrice'=>number_format($fullPrice),
            'transaltePrice'=>$transaltePrice,
            'sellRatePrice'=>$sellRatePrice,
            'lookMore'=>$lookMore
        );
        dd($myResultArr);
    }

    static protected function getStock($stockNumber){
        // dd(public_path());
        $cmd=escapeshellcmd(public_path().'\python\stockResult.py '.$stockNumber);//python sysv 第一個是執行的檔案名，後面開始是你添加的參數
        // dd($cmd);
        $result=shell_exec($cmd);
        return $result;
         
    }
}
