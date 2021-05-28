<!DOCTYPE html>
<html>
<head>
@include('library.basicNeed')
<link rel="stylesheet" href="{{asset('css/stock/calculator.css')}}" />
<link href="{{asset('css/fontAwesome/css/all.css')}}" rel="stylesheet"> <!--load all styles -->
<link href="{{asset('css/loading.css')}}" rel="stylesheet"> <!--load all styles -->
{{-- <script src="{{asset('dataTable/dataTable.js')}}"></script> --}}{{--dataTable不需要這個JS--}}
<script src="{{asset('dataTable/dataTableJquery.js')}}"></script>{{--dataTable需要這個JS--}}
<script src="{{asset('dataTable/dataTableMin.js')}}"></script>{{--dataTable需要這個JS--}}
<link rel="stylesheet" href="{{asset('dataTable/dataTable.css')}}" />{{--dataTable需要這個css--}}
<link rel="stylesheet" href="{{asset('dataTable/dataTableMin.css')}}" />{{--dataTable需要這個css--}}
<style>
/* @import url("https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap");
font-family: 'Noto Sans TC',sans-serif !important;
@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Quicksand&display=swap');
      body {
        font-family: 'Muli', sans-serif;
        color: rgba(0, 0, 0, 0.8);
        font-weight: 400;
        line-height: 1.58;
        letter-spacing: -.003em;
        font-size: 20px;
        padding: 70px;
      } */

</style>
</head>
<body>
    
<div id="mainContiainer">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#481717;" id="topBanner">
<a id="calculatorName" class="navbar-brand fingerMouse" style="color:white;font-size:2em;margin-left:2em;">股票計算機</a>
</nav>
<div class="container " id="mainContainer">

<div id="contextContainer1" class="row fixMb">

    <div class="col-md-3 mb-2">{{--這裡先控制你裡面的東西，他能分配12等分得多少--}}
        <div class="form-group">
            <label class="fontBoldBig ">股票編號</label>
            <input class="form-control" type="number" id="stockNumber" name="stock[stockNumber]" placeholder="Ex:2330"/>
        </div>
    </div>
    
    <div class="col-md-1 mb-2">
        <div class="form-group" >
            <button id="searchStock" class="btn btn-primary toTheBottom" style="margin-bottom:1em;">查詢</button>
        </div>
    </div>
    
</div>

<div id="contextContainer2" class="row fixMb" style="background-color: #e9ecef;display:none;">

    <div class="col-md-12  mt-2">
        <div class="form-group">
            <label class="fontBoldBig ">查詢結果</label>
        </div>
    </div>
    
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig ">股票名稱 : <span id="stockName"></span></label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig ">股票編號 : <span id="stockNum"></span></label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label  class="fontBig ">現價 : <span id="beTakePrice">540</span>/股</label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig ">一張(1000股) : <span id="stockFullPrice"></span> TWD</label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig ">手續費(買/賣 皆收) : <span id="stockTransalate"></span> TWD</label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig ">股票交易稅(賣出收) : <span id="stockSellRatePrice"></span> TWD</label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig "><b>做多</b>-不損失本金需以 : <span id="stockLookMore"></span><span>/股</span> 賣出</label>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mt-2">
        <div class="form-group" >
            <label class="fontBig "><b>做空</b>-不損失本金需以 : <span id="stockLookLess"></span><span>/股</span> 賣出</label>
        </div>
    </div>
    <hr>
    <div class="col-md-12  row">
        <div class="form-group mr-5 ml-3" >
            <button id="bringBuy" class="btn btn-danger">帶入買入</button>
        </div>

        <div class="form-group mr-5 ml-3" >
            <button id="bringSell" class="btn btn-success">帶入賣出</button>
        </div>

        <div class="form-group mr-5 ml-3" >
            <button id="closeResult" class="btn btn-secondary">收起結果</button>
        </div>
    </div>

    
</div>


<div id="contextContainer3" class="row fixMb">

    <div class="col-md-3 mb-2">
        <div class="form-group">
            <label class="fontBoldBig">交易類別</label>
            <select class="form-control">
                <option>現股</option>
                <option>現股當沖</option>
                <option>ETF</option>
            </select>
        </div>
    </div>

    <div class="col-md-3 mb-2">
        <div class="form-group">
            <label class="fontBoldBig">買入價格</label>
            <input class="form-control" type="number" id="stockbuyPrice" name="stock[buyPrice]"/>
        </div>
    </div>

    <div class="col-md-3 mb-2">
        <div class="form-group">
            <label class="fontBoldBig">賣出價格</label>
            <input class="form-control" type="number" id="stocksellPrice" name="stock[sellPrice]"/>
        </div>
    </div>

    <div class="col-md-3 mb-2">
        <div class="form-group">
            <label class="fontBoldBig">交易股數</label>
            <input class="form-control" type="number" id="stockquantity" name="stock[quantity]" value="1000"/>
        </div>
    </div>
</div>

{{--dataTable顯示--}}
<div id="dataTableContainer" style="display: none;">
    <table id="displayUserInputStockPrice" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr style="background-color: #dabb82;">
                <th>成交價格/股</th>
                <th>買入成本</th>
                <th>賣出實收</th>
                <th>買入手續費</th>
                <th>賣出手續費</th>
                <th>交易稅</th>
                <th>損益金額</th>
                <th>報酬率</th>
            </tr>
        </thead>
        <tbody id="myStockTbody">
            {{-- <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
            </tr> --}}
            
        </tbody>
    </table>

</div>

<div class="jumbotron col-md-12 mt-5" id="guideList" >
    <h1 class="mb-4">使用說明</h1>
    {{-- <hr> --}}
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><i class="fas fa-caret-right"></i>  公定手續費費率：0.1425%</li>
        <li class="list-group-item"><i class="fas fa-caret-right"></i>  證券交易稅稅率：0.3%</li>
        <li class="list-group-item"><i class="fas fa-caret-right"></i>  現股當沖證券交易稅稅率：0.15%</li>
        <li class="list-group-item"><i class="fas fa-caret-right"></i>  指數股票型基金（ETF）證券交易稅稅率：0.1%</li>
        <li class="list-group-item"><i class="fas fa-caret-right"></i>  小數點按四捨五入計算</li>
    </ul>
</div>

</div>


</div>
<div class="modal"><!-- Place at bottom of page --></div>
<script>
$body = $("body");

/*
用來擷取相關小數點第幾位以後四捨五入
*/
function formatFloat(num, pos)
{
  var size = Math.pow(10, pos);
  return Math.round(num * size) / size;
}


function drawStockTable(finalStockArray){//畫出畫面上的dataTable
    // console.log(finalStockArray);
    var drawTbody='';
    
    finalStockArray.forEach(function(element){
        var tdString='';
        
        if(element.profitGood==true){
            tdString+='<td style="color:green;">'+element.earnOrLose+'</td>'+
                '<td style="color:green;">'+element.earnOrLosePercentage+'%</td>';
        }else{
            tdString+='<td style="color:red;">'+element.earnOrLose+'</td>'+
                '<td style="color:red;">'+element.earnOrLosePercentage+'%</td>';
        }
        drawTbody+='<tr>'+
                '<td>'+element.price+'</td>'+
                '<td>'+element.buyPriceTotal+'</td>'+
                '<td>'+element.sellPriceTotal+'</td>'+
                '<td>'+element.buyInTax+'</td>'+
                '<td>'+element.sellOutTax+'</td>'+
                '<td>'+element.tranlateTax+'</td>'+
                tdString+
            '</tr>'
    });

    $('#myStockTbody').html(drawTbody);
}


function lookMoreFunc(buyInPrice,sellPrice,transaltePrice=0.001425,TradeTax=0.003){
    
    var sellPriceArrayMinus=[],sellPriceArrayPlus=[],buyPriceTotal,sellTradeTax,
    buyTransaltePrice,sellTransaltePrice,finalStockArray,numberCount;
    buyInPrice=parseFloat(buyInPrice);
    sellPrice=parseFloat(sellPrice);
    
    
    buyTransaltePrice=parseInt(Math.round(buyInPrice*1000*transaltePrice));//買入的手續費
    
    
    if(buyTransaltePrice<20){
        buyTransaltePrice=20;
    }
    

    buyPriceTotal=(buyInPrice*1000)+buyTransaltePrice;
    


    
    if(sellPrice>0 && sellPrice<10){//0~9.99都是0.01 這樣在增加
        numberCount=0.01;
    }else if(sellPrice<50 && sellPrice>=10){//10~50內，是0.05這樣增加
        numberCount=0.05;
    }else if(sellPrice<100 && sellPrice>=50){//100~50內，是0.1這樣增加
        numberCount=0.1;
    }else if(sellPrice<500 && sellPrice>=100){//100~500內，是0.5這樣增加
        numberCount=0.5;
    }else if(sellPrice<1000 && sellPrice>=500){//1000~500內，是1這樣增加
        numberCount=1;
    }else if(sellPrice>=1000){//1000以上，是5這樣增加
        numberCount=5;
    }

        for(var a=1;a<=5;a++){
            sellTransaltePrice=parseInt(Math.round(((sellPrice-(a*numberCount))*1000)*transaltePrice));//賣出的手續費
            if(sellTransaltePrice<20){
                sellTransaltePrice=20;
            }
            //以下為-數的部分
            
            
            var sellPriceTotalMinus=Math.round((((sellPrice-(a*numberCount))*1000)-sellTransaltePrice)-((Math.round(((sellPrice-(a*numberCount))*1000)*TradeTax))));
            
            

            sellPriceArrayMinus[a]={
                'price':formatFloat(sellPrice-(a*numberCount),2),
                'buyPriceTotal':buyPriceTotal,
                'sellPriceTotal':sellPriceTotalMinus,
                'buyInTax':buyTransaltePrice,
                'sellOutTax':sellTransaltePrice,
                'tranlateTax':parseInt(Math.round(((sellPrice-(a*numberCount))*1000)*TradeTax)),
                'earnOrLose':sellPriceTotalMinus-buyPriceTotal,
                'earnOrLosePercentage':formatFloat(((formatFloat(((sellPriceTotalMinus-buyPriceTotal)/buyPriceTotal),3))*100),3),
                'profitGood':((sellPriceTotalMinus-buyPriceTotal)>0?true:false)
            
            };

            

            //以下為+數的部分
            sellTransaltePrice=parseInt(Math.round(((sellPrice+(a*numberCount))*1000)*transaltePrice));//賣出的手續費
            if(sellTransaltePrice<20){
                sellTransaltePrice=20;
            }
            var sellPriceTotalPlus=Math.round((((sellPrice+(a*numberCount))*1000)-sellTransaltePrice)-((Math.round(((sellPrice+(a*numberCount))*1000)*TradeTax))));
            sellPriceArrayPlus[a]={
                'price':formatFloat(sellPrice+(a*numberCount),2),
                'buyPriceTotal':buyPriceTotal,
                'sellPriceTotal':sellPriceTotalPlus,
                'buyInTax':buyTransaltePrice,
                'sellOutTax':sellTransaltePrice,
                'tranlateTax':parseInt(Math.round(((sellPrice+(a*numberCount))*1000)*TradeTax)),
                'earnOrLose':sellPriceTotalPlus-buyPriceTotal,
                'earnOrLosePercentage':formatFloat(((formatFloat(((sellPriceTotalPlus-buyPriceTotal)/buyPriceTotal),3))*100),3),
                'profitGood':((sellPriceTotalPlus-buyPriceTotal)>0?true:false)//判斷是否無損失
            
            };
            
            
        }
        sellPriceArrayMinus=sellPriceArrayMinus.reverse();

        //自己輸入的賣出價格處理
        var nowSellTransaltePrice=parseInt(Math.round((sellPrice*1000)*transaltePrice));//賣出的手續費
            if(nowSellTransaltePrice<20){
                nowSellTransaltePrice=20;
            }

        
        var nowSellPriceTotal=Math.round((((sellPrice)*1000)-nowSellTransaltePrice)-((Math.round(((sellPrice)*1000)*TradeTax))));
        var nowTranlateTax=parseInt(Math.round((sellPrice*1000)*TradeTax));

        var nowSellPrice={
                'price':sellPrice,
                'buyPriceTotal':buyPriceTotal,
                'sellPriceTotal':nowSellPriceTotal,
                'buyInTax':buyTransaltePrice,
                'sellOutTax':nowSellTransaltePrice,
                'tranlateTax':nowTranlateTax,
                'earnOrLose':nowSellPriceTotal-buyPriceTotal,
                'earnOrLosePercentage':formatFloat(((formatFloat(((nowSellPriceTotal-buyPriceTotal)/buyPriceTotal),3))*100),3),
                'profitGood':(nowSellPriceTotal-((buyPriceTotal)+buyTransaltePrice)>0?true:false)//判斷是否無損失
        };
        sellPriceArrayMinus.push(nowSellPrice);
        finalStockArray=sellPriceArrayMinus.concat(sellPriceArrayPlus);
        // console.log(sellPriceArrayMinus);
        // console.log(sellPriceArrayPlus);
        // console.log(finalStockArray);
        drawStockTable(finalStockArray);
        
}



$(function(){

//發現好像不用用dataTable就可以完成功能惹
// $('#displayUserInputStockPrice').DataTable({
//     "bPaginate": false,//這個參數是拿掉下一頁的功能，所以原本設定10行為一頁的功能會失效，直接顯示全部
//     "bInfo": false,//現在是顯示第幾頁第幾個資料的功能，拿掉就不顯示了
//     "bFilter": false,//搜尋的輸入欄位，拿掉就不顯示了
// });  

$('#calculatorName').on('click',function(){
    window.location='/stockCalculator';
});


$('#bringBuy').on('click',function(){
    var nowGetBuy=$('#stockbuyPrice').val($('#beTakePrice').text());
    if($('#beTakePrice').text()>0 && $('#stocksellPrice').val()>0){
        $('#dataTableContainer').css('display','block');
        
    }else{
        $('#dataTableContainer').css('display','none');
    }
});

$('#bringSell').on('click',function(){
    var nowGetSell=$('#stocksellPrice').val($('#beTakePrice').text());
    if($('#stockbuyPrice').val()>0 && $('#beTakePrice').text()>0){
        $('#dataTableContainer').css('display','block');
    }else{
        $('#dataTableContainer').css('display','none');
    }
});


$('#stockbuyPrice').on('keyup',function(){
     let buyPrice=$(this).val();
    if(buyPrice>0 && $('#stocksellPrice').val()>0){
        lookMoreFunc(buyPrice,$('#stocksellPrice').val());
        $('#dataTableContainer').css('display','block');
    }else{
        $('#dataTableContainer').css('display','none');
    }
});

$('#stocksellPrice').on('keyup',function(){
     let sellPrice=$(this).val();
    if(sellPrice>0 && $('#stockbuyPrice').val()>0){
        lookMoreFunc($('#stockbuyPrice').val(),sellPrice);
        $('#dataTableContainer').css('display','block');
    }else{
        $('#dataTableContainer').css('display','none');
    }
});

$('#stockbuyPrice').on('change',function(){
     let buyPrice=$(this).val();
    if(buyPrice>0 && $('#stocksellPrice').val()>0){
        lookMoreFunc(buyPrice,$('#stocksellPrice').val());
        $('#dataTableContainer').css('display','block');
    }else{
        $('#dataTableContainer').css('display','none');
    }
});

$('#stocksellPrice').on('change',function(){
     let sellPrice=$(this).val();
    if(sellPrice>0 && $('#stockbuyPrice').val()>0){
        lookMoreFunc($('#stockbuyPrice').val(),sellPrice);
        $('#dataTableContainer').css('display','block');
    }else{
        $('#dataTableContainer').css('display','none');
    }
});






$('#searchStock').click(function(){
    $body.addClass("loading");
    let stockName=$('#stockNumber').val();
    stockName=stockName.replace(/ /g,'');
    // console.log(stockName);
    if(stockName=='' || stockName==undefined){
        alert('請輸入股票編號');
        $body.removeClass("loading");
    }else{
        $.ajax({
            url:"stockDetail",
            data:{stockNumber:stockName},
            type:'GET',
            dataType:'json',
            success:function(response){
                console.log(response);
                if(response.status==200){
                    $('#stockName').text(response.data.name);
                    $('#stockNum').text(response.data.stockNum);
                    $('#beTakePrice').text(response.data.eachPrice);
                    $('#stockFullPrice').text(response.data.fullPrice);
                    $('#stockTransalate').text(response.data.transaltePrice);
                    $('#stockSellRatePrice').text(response.data.sellRatePrice);
                    $('#stockLookMore').text(response.data.lookMore);
                    $('#stockLookLess').text(response.data.lookLess);
                    $('#contextContainer2').css('display','block');
                }else{
                    alert('資料忙碌中，請稍後再試一次');
                }
                
            }
        }).fail(function(errorMsg){
                alert(errorMsg.responseJSON.message);
        }).always(function(){
            $body.removeClass("loading");
        });
    }

    
});

$('#closeResult').click(function(){
    $('#contextContainer2').css('display','none');
});

});
</script>


</body>
</html>



