@extends('layout.master')
@section('libraryCSS')
<style>
    .leaderboard-toolbar{
        background-color: #0096A9 /*blue*/;
        color:#fff;
    }
    .circle{
        width: 75px;
	height: 75px;
        border: solid white;
        -moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
        padding: 10px;
        margin: 10px 10px 20px 10px;
    }
    .avatar-user{
        width: 50px;
        height: 50px;
    }
    .badge-notify-avatar{
                background:#FE9700 /*orange*/;
                color:#fff;
                position:relative;
                top: 20px;
                left: -60px;
    }
    .arrow-up {
        width: 0; 
        height: 0; 
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 15px solid black;
        display: block;
    }
    .arrow-down {
        width: 0; 
        height: 0; 
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 15px solid #f00;
}
    .color-green{
        border-bottom-color: green;
    }
    .color-orange{
        border-top-color: #FE9700;/*orange*/
    }
    .font-green{
        color: green;
    }
    .font-orange{
        color: #FE9700;/*orange*/
    }
    
    .table>tbody>tr>td{
        vertical-align: middle;
    }
    
    .table{
        border-radius: 10px;
    }
    
    .objective-name{
        border:solid white 2px; 
        border-radius: 35%; 
        float:none!important;
        color:white;
        background-color: #FE9700; /*orange */
        margin-top:-20px;
    }
    
    .toolbaractive{
        color:#0096A9; /*blue*/
        background-color: white;
        
    }
    .name{
        font-weight: bold;
    }
</style>
@stop
@section('libraryJS')
@stop

@section('pageheading')
Objectives Leaderboard
@stop

@section('content')
<div class="container-fluid">
<div class="row leaderboard-toolbar">
    <h4 class="text-center ">Sales Activity</h4><br>
<!--    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">        
        <div class="circle btn">
            1
            <br>
            Day
        </div>
        <div class="circle btn toolbaractive">
            1
            <br>
            Week
        </div>
        <div class="circle btn">
            1
            <br>
            Month
        </div>
    </div>-->
</div>
<div  class="row " style="position:relative;">
    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 center-block text-center objective-name " >
      <h5>Leaderboard :  {{Session::get('region')}}</h5>
    </div>
</div>
</div>
<div> 
    
    <table class="table" style="background-color: #fff; margin-top:15px">
        <thead> 
            <tr>
                <td class="name">
                    <h4 style="font-weight:bold">Rank</h4>
                </td>
                <td class="name">
                    <h4 style="font-weight:bold">Name</h4>
                </td>
                <td class="name">
                    <h4 style="font-weight:bold">Territory</h4>
                </td>
                <td class="name">
                    <h4 style="font-weight:bold" class="text-right">points</h4>
                </td>
            </tr>
        </thead>
        @foreach($objleaderboarddata as $leaddata)
        <tr valign="middle">
            <td class="name"><h4>{{$leaddata->rank}}</h4></td>
            <td class="name"><h4>{{$leaddata->user_name}}</h4></td>
            <td class="name"><h4>{{$leaddata->territory}}</h4></td>
            <td><h4 class=" text-right ">{{$leaddata->points}}</h4></td>
        </tr>
        @endforeach
    </table>
</div>
@stop