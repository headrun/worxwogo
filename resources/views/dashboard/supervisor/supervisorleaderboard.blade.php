@extends('layout.supervisormaster')

@section('libraryCSS')

<link rel="stylesheet" href="{{url()}}/assets/css/supervisorleaderboard.css">

@stop
@section('libraryJS') 

<script>var obj_id="{{$obj_id}}"; var apiurl="{{url()}}";</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{url()}}/assets/js/supervisorleaderboard.js" ></script>

@stop


@section('pageHeading')

Leaderboard

@stop

@section('toolbar')
<div class=" container-fluid ">
      <div class="row toolbar">
        
        <div class="col-lg-4 col-md-4  col-sm-5 col-xs-5">
          <div class=" obj_dropdowndiv  dropdown">
            <button class="btn btn-default dropdown-toggle obj_dropdown " type="button" data-toggle="dropdown">
            <?php 
              foreach($objectiveslist as $obj){
                if($obj_id=="$obj->obj_id"){
                  echo $obj->objective_name;
                }  
              }
              if($obj_id=='All'){
                echo $obj_id;
              }
              
            ?>
            <span class="caret"></span></button>

            <ul class="dropdown-menu">
            @foreach($objectiveslist as $obj)
              <?php if($obj_id!="$obj->obj_id"){ ?>
              
              <li><a href="{{url()}}/dashboard/supervisorleaderboard/{{$obj->obj_id}}">{{$obj->objective_name}}</a></li>
              
              <?php } ?>
            @endforeach
            <?php if($obj_id!='All'){ ?>
            
            <li><a href="{{url()}}/dashboard/supervisorleaderboard/All">All</a></li>
            <?php } ?>
            </ul>
          </div>
        </div>

        <div class="col-lg-4 col-md-4  col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4  col-sm-5 col-xs-5">
          <button class="btn btn-default  btn-sm  toolbar-btn ytd-btn">YTD</button>
          <button class="btn btn-default  btn-sm toolbar-btn  mtd-btn active">MTD</button>
        </div>

      </div>
    </div>

@stop
@section('mainBody')
<!--Card-->
    <div class="card" title="">
      <!--Card content-->
      <div class="card-block">
        
        
        
       
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->
@stop

@section('extra')

<leaderboard-block hidden>
  <div class="leaderboard-block">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 center-block text-center" >
            <span class="leaderboard-rank"> 1 </span>
            <i class="fa fa-user-circle hidden-xs" aria-hidden="true"></i>  
            <!--<span><img class="avatar img-responsive" src="" alt="img"></span> -->

          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
            <b class="username">Name Here</b>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center pointbox">
             <div class="leaderboardpoints"></div>
             <!--<span class="borderbox"><span class="points">points here</span></span>-->
          </div>
        </div>
        <!--Text-->
        <div class="row">
          <div class="col-lg-2  col-md-2  col-sm-2 col-xs-2">
          </div>

          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-center">
            <div  class="leaderboardchart" ></div>
              <div class=' row icons'>
                

                <a class="leaderboardmsg" href="{{url()}}/dashboard/sendmsg">
                  <div class="col-lg-4 col-md-4  col-sm-4 col-xs-4  center-block text-center  leaderboardmsg">
                    <i class="fa fa-envelope-open fa-leaderboard-btn leaderboardmsg" aria-hidden="true"></i>
                  </div>
                </a>
                <a class="leaderboardlike" href="{{url()}}/dashboard/sendlike">
                  <div class="col-lg-4 col-md-4  col-sm-4 col-xs-4  center-block text-center ">
                    <i class="fa fa-thumbs-up fa-1x fa-leaderboard-btn " aria-hidden="true"></i>
                  </div>
                </a>
                <a class="call" href="#">
                  <div class="col-lg-4 col-md-4  col-sm-4 col-xs-4  center-block text-center ">
                    <i class="fa fa-phone  fa-leaderboard-btn" aria-hidden="true"></i>
                  </div>
                </a>
              
              </div>
            <hr>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          
          </div>
        </div>
        </div>
  </leaderboard-block>


@stop




