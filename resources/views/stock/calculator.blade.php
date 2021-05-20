<!DOCTYPE html>
<html>
<head>
@include('library.basicNeed')
<link rel="stylesheet" href="{{asset('css/stock/calculator.css')}}" />
<link href="{{asset('css/fontAwesome/css/all.css')}}" rel="stylesheet"> <!--load all styles -->
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
<script>
$(function(){
$('#calculatorName').on('click',function(){
    window.location='/stockCalculator';
});


$('#bringBuy').on('click',function(){
    $('#stockbuyPrice').val($('#beTakePrice').text());
});

$('#bringSell').on('click',function(){
    $('#stocksellPrice').val($('#beTakePrice').text());
});

$('#searchStock').click(function(){

    let stockName=$('#stockNumber').val();
    stockName=stockName.replace(/ /g,'');
    // console.log(stockName);
    if(stockName=='' || stockName==undefined){
        alert('請輸入股票編號');
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
                alert('伺服器忙線中，請聯繫管理員');
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



