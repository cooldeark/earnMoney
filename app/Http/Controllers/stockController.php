<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fuck;

class stockController extends Controller implements Fuck
{
    public function calculator(){
        return view('stock.calculator');
        
        // $myResult=$this->getStock();
        
    }


    public function test(){
        echo 'hey';
    }

    public function calculatorPost(Request $req){
        $userInput=preg_replace('/\D/', '', $req->stockNumber);
        // $userInput='fuck';
        $userInput=(int)$userInput;
        
        if($userInput==0){//代表丟進來的不是數字，不給他用拉，防止外面給我丟什麼東西進來什麼JS INJECTION東西的
            $myJson=array(
                'status'=>403
            );
            return response(json_encode($myJson),403);
        }else{
            $getFullInfo=json_decode($this->getStock($req->stockNumber));
        // dd($stockResult->info->name);
        // $stockResult=(int)$stockResult->realtime->latest_trade_price;//不知道為什麼開盤會沒有值，所以取best_bid_price，雖然會差一點就是了
        $stockResult=(float)$getFullInfo->realtime->best_bid_price[0];
        // dd($stockResult);
        $fullPrice=$stockResult*1000;
        $transaltePrice=(int)round($fullPrice*0.001425);//round四捨五入，然後再加上int是為了讓他完全整數不留浮點數
        $sellRatePrice=(int)round($fullPrice*0.003);

        if($transaltePrice<20){//最低手續費20，不滿20算20
            $transaltePrice=20;
        }

        $lookMore=($fullPrice+($transaltePrice*2)+$sellRatePrice)/1000;//買入賣出都有成本所以手續費要兩次
        $lookLess=($fullPrice-($transaltePrice*2)-$sellRatePrice)/1000;//買入賣出都有成本所以手續費要兩次
        // dd($lookMore);
        /**
         * round($n)  四捨五入
            *ceil($n)   無條件進位
            *floor($n)  無條件捨去
         */

        if($stockResult<10 && $stockResult>0){//0~9.99都是0.01 這樣在增加
            $lookMore=floor(($lookMore+0.01)*100)/100;//這樣是取小數點後兩位的方式，超好用
            $lookLess=floor(($lookLess-0.01)*100)/100;
        }else if($stockResult<50 && $stockResult>=10){//10~50內，是0.05這樣增加
            // dd(substr($lookMore,6,1));
            if((substr($lookMore,4,1)==0 || substr($lookMore,4,1)=="") && (substr($lookMore,5,1)==0 || substr($lookMore,5,1)=="")){//取不到值會是""
                //代表是整數，45.6之類的，就不用去處理他
            }else{
                $lookMore=sprintf('%.1f', (float)$lookMore);//因為我們都是0.05做一個級距，所以要先清除小數點後一位的數字，再來加上0.05 這樣才不損失本金
                $lookLess=sprintf('%.1f', (float)$lookLess);
                $lookMore=floor(($lookMore+0.05)*100)/100;
                $lookLess=floor(($lookLess-0.05)*100)/100;
            }
            
            
            
        }else if($stockResult<100 && $stockResult>=50){//100~50內，是0.1這樣增加
            // dd($lookMore);
            if((substr($lookMore,4,1)==0 || substr($lookMore,4,1)=="") && (substr($lookMore,5,1)==0 || substr($lookMore,5,1)=="")){
                //代表是整數55.9之類的
            }else{
                $lookMore=sprintf('%.1f', (float)$lookMore);
                $lookLess=sprintf('%.1f', (float)$lookLess);
                $lookMore=floor(($lookMore+0.1)*10)/10;
                $lookLess=floor(($lookLess-0.1)*10)/10;
            }
                
            
            
        }else if($stockResult<500 && $stockResult>=100){//100~500內，是0.5這樣增加 
            // dd($lookMore);
            
            if((substr($lookMore,4,1)==0 || substr($lookMore,4,1)==5) && substr($lookMore,5,1)==""){
                //如果小數點第一位等於0或5就不用在幫他加上去了
            }else if(substr($lookMore,4,1)>5){
                $lookMore=sprintf('%.1f', (float)$lookMore);
                $lookLess=sprintf('%.1f', (float)$lookLess);
                $lookMore=ceil($lookMore);
                $lookLess=ceil($lookLess);
            }else if(substr($lookMore,4,1)<5 && substr($lookMore,5,1)!=""){
                $lookMore=(int)$lookMore+0.5;
                $lookLess=(int)$lookLess-0.5;
            }


        }else if($stockResult<1000 && $stockResult>=500){//1000~500內，是1這樣增加
                $lookMore=(int)floor($lookMore+1);
                $lookLess=(int)floor($lookLess-1);
            
        }else if($stockResult>=1000){//1000以上，是5這樣增加
            $lookMore=(int)floor($lookMore+5);
            $lookLess=(int)floor($lookLess-5);
        }


//未來要增加五日線平均價格，或是一些常用知道現在入手是高還是低的分析

        

        $myResultArr=array(
            'name'=>$getFullInfo->info->name,
            'stockNum'=>$getFullInfo->info->code,
            'eachPrice'=>$stockResult,
            'fullPrice'=>number_format($fullPrice),
            'transaltePrice'=>$transaltePrice,
            'sellRatePrice'=>$sellRatePrice,
            'lookMore'=>$lookMore,
            'lookLess'=>$lookLess
        );
        
        $myJson=array(
            'status'=>200,
            'data'=>$myResultArr
        );
        return response(json_encode($myJson),200);
        }
        
    }

    static protected function getStock($stockNumber){
        // dd(public_path());
        $cmd=escapeshellcmd(public_path().'\python\stockResult.py '.$stockNumber);//python sysv 第一個是執行的檔案名，後面開始是你添加的參數
        // dd($cmd);
        $result=shell_exec($cmd);
        return $result;
         
    }
}
