@extends('layout.supervisormaster')

@section('libraryCSS')

 <link rel="stylesheet" href="{{url()}}/assets/css/sosupleadboard.css">

@stop



@section('libraryJS')
<script>var so_id={{$user_data->emp_code}}</script>
<script type="text/javascript" src="{{url()}}/assets/js/loader.js"></script> 

<script type="text/javascript" src="{{url()}}/assets/js/sodetails.js"></script> 



@stop

@section('pageHeading')
	Leaderboard
@stop

@section('mainBody')

<div class="row sotoolbar">
 
 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
 		<h4 class="soimg pull-left"><i class="fa fa-user-circle fa-1x" aria-hidden="true"></i> {{$user_data->name}}</h4>
 	</div>
 	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
 		<h4 class="soName text-center">
 			<span class="sopoints text-center">{{$user_data->user_points}} points</span>
    </h4>
 	</div>
 
</div>


<div class="socards">

</div>




@stop


@section('extra')
 
  <quantity  hidden >
            <!--Card-->
            <div class="card qty" title="">
                <!--Card content-->
                <div class="card-block">
                    <!--Title-->
                    <div class="row">
                        <div class=" qtytitle col-lg-8  col-md-8  col-sm-8 col-xs-9">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
                            <h5 class="card-title text-right">Points</h5>
                        </div>
                    </div>
                    <!--Text-->
                    <div class="row">
                        <div class="col-lg-8  col-md-8  col-sm-8 col-xs-8">
                            <div class="milestonediv">
                                <label class="text-center milestone" >MILESTONE <br>
                                <span class="highestachno"> </span>
                                </label>
                                <span class="qtycurrentno"></span>
                            </div>
                            <br>
                        </div>
                        <div class="col-lg-4  col-md-4  col-sm-4 col-xs-4">
                            <h2 class="text-right objpoints" ></h2>
                        </div>
                    </div>
       
                </div>
                <!--/.Card content-->

            </div>
            <!--/.Card-->
    </quantity>
    <target hidden>
        <!--Card-->
        <div class="card target" title="" >
            <!--Card content-->
            <div class="card-block">
                <!--Title-->
                <div class="row">
                    <div class=" targettitle col-lg-8  col-md-8  col-sm-8 col-xs-8">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="col-lg-4  col-md-4  col-sm-4 col-xs-4">
                        <h5 class="card-title text-right targetpoints">Points</h5>
                    </div>
                </div>
                <!--Text-->
                <div class="row">
                    <div class="col-lg-8  col-md-8  col-sm-8 col-xs-8">                
                        <div class=" progress " >
                            <div class="progress-bar progress-bar-striped active " role="progressbar" aria-valuenow=""
                                aria-valuemin="0" aria-valuemax="" >
                                <label class="progress-text"></label>
                            </div>
                            <div class="progress-text"></div>
                        </div>
                
                        <div class="row comment" >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 legend2">
                                <div class="skewindicator"></div>
                                <label class="achvdvalue" >Achieved: </label>&nbsp;
                                <div class="clearfix visible-xs"></div>
                                <div class="boxdiv color-ghostblack" ></div>
                                <label class="targetvalue"></label>
                                
                                <div class="clearfix visible-xs"></div>
                                <div class="boxdiv color-ghostwhite"></div>
                                <label class="tobeachvd">To be Achieved:  </label>
                    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-4  col-sm-4 col-xs-4">
                        <h2 class="text-right objpoints" ></h2>
                    </div>
                </div>
            </div>
            <!--/.Card content-->
        </div>
        <!--/.Card-->
</target>

<range hidden>
    
    <!--Card-->
    <div class="card range" title="" >
        <!--Card content-->
        <div class="card-block">
            <!--Title-->
            <div class="row">
                <div class="col-lg-8  col-md-8  col-sm-8 col-xs-8">
                    <h4 class="card-title"></h4>
                </div>
                <div class="col-lg-4  col-md-4  col-sm-4 col-xs-4">
                     <h5 class="card-title text-right">Points</h5>
                </div>
            </div>
            <!--Text-->
        
            <div class="row">
                <div class="col-lg-8  col-md-8  col-sm-8 col-xs-8">
                    <div  class="chart" ></div>
                    <div class="row comment" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left legend2">
                            <div class="badcommon color-red"></div>
                            <label class="bad">Bad []%  </label>&nbsp;
                            <div class="clearfix visible-xs"></div>
                            <div class="goodcommon color-orange"></div>
                            <label class="good">Good []% </label>&nbsp;
                            <div class="clearfix visible-xs"></div>
                            <div class="vgoodcommon color-lightgreen"></div>
                            <label class="vgood">Very Good []%  </label>
                            
                            <div class="clearfix visible-xs"></div>
                            <label class="newseg">[% of ] </label>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  col-md-4  col-sm-4 col-xs-4">
                    <h2 class="text-right objpoints" ></h2>
                </div>
            </div>
        
        </div>
        <!--/.Card content-->

    </div>
    <!--/.Card-->

</range>
    

@stop