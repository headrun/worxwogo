<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- CSS -->
        <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        
        <style>
                          @media(max-width:767px){
                h4 {
                font-size: 4vw;
                }
                h5{
                font-size: 3vw;
                }
                td{
                font-size: 2.5vw;
                }
                .img-circle{
                    margin-top: 14px;
                    width:80%;
                }
                .fa-sign-out{
                    font-size:2.5em!important;
                    padding:4px !importnat;
                    
                }
                
                .badges{
                    width:75px!important;
                    height:75px!important;
                }
                
                .page-heading{
                    font-size:12px; 
                }
                
                .page-name{
                    font-size:15px;
                }
                .hbrand{
                    height:105px;
                    width:105px;
                    border-radius: 50%;
                    border: solid white 3px;
                }
                
                .navbar-collapse.collapse {
                    display: block!important;
                }

                .navbar-nav>li, .navbar-nav {
                    float: left !important;
                }

                .navbar-nav.navbar-right:last-child {
                    margin-right: -15px !important;
                }
                #lastupdate{
                    margin-top:62px;
                    margin-left:25px;
                    font-size:10px;
                }
                
            }
            @media(min-width:768px){
                h4 {
                font-size: 3vw;
                }
                h5{
                font-size: 2.5vw;
                }
                td{
                font-size: 1.5vw;
                }
                .img-circle{
                    margin-top: 10px;
                    width:60%;
                }
                
                .fa-sign-out{
                    font-size:4em;
                    padding:8px;
                    
                }
                .page-heading{
                    font-size:12px; 
                }
                
                .page-name{
                    font-size:15px;
                }
                
                .hbrand{
                    height:105px;
                    width:180px;
                    border-radius: 50%;
                    border: solid white 3px;
                }
                .navbar-nav.navbar-right:last-child {
                    margin-right: 0px !important;
                }
                #lastupdate{
                    margin-top:100px;
                    margin-left:45px;
                    font-size:12px;
                }
 
            }
            @media(min-width:992px){
                h4 {
                font-size: 1.4vw;
                }
                h5{
                font-size: 1.2vw;
                }
                td{
                font-size: 1vw;
                }
                .img-circle{
                    margin-top: 10px;
                    width:50%;
                }
                .fa-sign-out{
                    font-size:4em;
                    padding:8px;
                    
                }
                .hbrand{
                    height:105px;
                    width:190px;
                    border-radius: 50%;
                    border: solid white 4px;
                }
                #lastupdate{
                    margin-top:100px;
                    margin-left:45px;
                    font-size:12px;
                }
            }
            @media(min-width:1200px){
                h4 {
                font-size: 1.5vw;
                }
                h5{
                font-size: 1.3vw;
                }
                td{
                font-size: 1vw;
                }
                .hbrand{
                    height:105px;
                    width:200px;
                    border-radius: 50%;
                    border: solid white 5px;
                }
                .fa-sign-out{
                    font-size:5em;
                    padding:8px;
                    
                }

                
                .page-heading{
                    font-size:15px; 
                }
                
                .page-name{
                    font-size:13px;
                }
                
                #lastupdate{
                    margin-top:100px;
                    margin-left:45px;
                    font-size:12px;
                }
                
            }
            
            .navbar-default{
                background-color:#00BBD3;
                border-color:#00BBD3 !important;
            }
            .navbar{
                    min-height: 130px;
                    margin-bottom:0px!important;
                }
            .active{
                color: black;
            }
            
 
            .navbar-right {
                float: right!important;
            }

            .navbar-brand{
                position: absolute;
                width: 100%;
                left: 0;
                text-align: center;
                margin:0 auto;
            }
            .navbar-toggle {
                z-index:3;
            }


            .border{
                border:solid black 5px; padding:10px;
            }
            label{
                color:black;
            }
            
            /*for all*/
            @media (min-width:0px) and (max-width:1500px) {
                #exTab3 .nav-pills > li > a {
                     border-radius: 4px 4px 0 0 ;   
                }   

                #exTab3 .tab-content {
                    color : black;
                    background-color: #fff;
                    padding : 5px 15px;
                    border-radius:5px;
                    box-shadow:6px 6px 3px #888888;
                }
                .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
                    background-color: white;
                    color:#337ab7;
                }
                .link{
                    color:#000;
                }
            }
            .leaderboard-toolbar{
                background-color: #0096A9 /*blue*/;
                color:#fff;
            }
        </style>
          <!-- JS -->
        <script src="{{url()}}/assets/js/jquery.js"></script>
        <script src="{{url()}}/assets/js/bootstrap.min.js"></script>
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71192393-4', 'auto');
  ga('send', 'pageview');
  ga('set', 'userId', {{Session::get('empId')}});

        </script>

    </head>
    <body class="" style="background-color:#F0F0F0">
        
         <!-- header -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation"  >
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <label style="color:white;"></label>
                        <h4 class="text-center" style="color:white;">Profile Info   
                        </h4>
                        
                    </div>
                </div>
                <div class="nav navbar-nav navbar-left">
                    <a class="" href="{{url()}}/dashboard/index">
                        <img src="{{url()}}/assets/img/logo/{{Session::get('clientId')}}{{$client_data['client_logo_ext']}}"" class="visible-xs " height="63px" width="100px" style="margin-top:0px;border:solid 2px black;position:absolute;"/>
                        <img src="{{url()}}/assets/img/logo/{{Session::get('clientId')}}{{$client_data['client_logo_ext']}}"" class="hidden-xs" height="71px" width="175px" style="margin:25px;border:solid 2px black;position:absolute;"/>
                    </a>
                    <label id="lastupdate" style="color:white"><em>Last update: <br class="visible-xs">{{ date('d-m-Y',strtotime($client_last_updated['created_at']))}} </em></label>
                </div>
                
                <div class="nav navbar-nav navbar-right text-right">
                    <span >
                    <a class="navbar-right" href="{{url()}}/vault/logout">
                        <i class="fa fa-sign-out text-right" aria-hidden="true" style="position: relative;">
                         <br>
                         <h4 style="cursor:none; color:white;">
                             {{ date('M Y')}},<br class="visible-xs">
                         Days Left:
                        <?php 
                            $daysRemaining = (int)date('t',strtotime(date("Y-m-d")) ) - (int)date('j', strtotime(date("Y-m-d")));
                            echo $daysRemaining;
                        ?>
                        </h4>
                        </i>
                    </a>
                    </span>
                </div>
            </div>
        </nav>
<div class="row leaderboard-toolbar">
    <h4 class="text-center ">{{$client_data['program_name']}}</h4><br>
</div>

        <!-- header -->

        
        
        <br>
        
        
        <h4 class="text-center">{{$userdata->name}}</h4>
            <div id="exTab3" class="container">	
                <ul  class="nav nav-pills">
                    <li class="active">
                        <a  class="link" href="#1b" data-toggle="tab"><h5>Badges</h5></a>
                    </li>
                    <li><a class="link" href="#2b" data-toggle="tab"><h5>Game Card</h5></a>
                    </li>
                    <li><a class="link" href="#3b" data-toggle="tab"><h5>Profile</h5></a>
                    </li>
                </ul>

		<div class="tab-content clearfix">
                    <div class="tab-pane active" id="1b">
                        @if(!count($badges_data))
                        <h4>You are still to Win your 1st badge</h4>
                        @else
                        <div class="row">
                            @foreach($badges_data as $badge)
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 text-center">
                                <img class="badges" src="{{url()}}/assets/img/Badges/{{$badge->badge_img_name}}" style="height:150px;width:150px;"/>
                                <br>
                                <h5 class="text-center" style="font-weight:lighter;">{{$badge->badge_name}}</h5>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="2b">
                        <h5>How to Earn Points ?</h5>
                        <table class="table-condensed table-responsive" width="100%" style="border-radius:5px;"> 
                            <thead style="background-color:#6F6F6F;color:white;">
                                <tr>
                                <th>Sr</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td>1</td>
                                    <td>MSP (Value)</td>
                                    <td>Every % achievement of MSP (in Rs. Lacs) against the monthly target</td>
                                    <td class="text-right">20</td>
                                </tr>
                                <tr style="background-color:lightgrey;">
                                    <td rowspan="2">2</td>
                                    <td rowspan="2">Category Mix – Truck (Qty)</td>
                                    <td>If the percentage target achievement for the truck category is between 70-89%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr style="background-color:lightgrey;">
                                        <td>If the percentage target achievement for the truck category is greater than 90%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr >
                                    <td rowspan="2">3</td>
                                    <td rowspan="2">Category Mix Non–Truck (Qty)</td>
                                    <td>If the percentage target achievement for the non-truck category is between 50-69%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr>
                                        <td>If the percentage target achievement for the non-truck category is greater than 70%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr style="background-color:lightgrey;">
                                    <td rowspan="2">4</td>
                                    <td rowspan="2">Category Mix – 2/3 Wheelers (Qty)</td>
                                    <td>If the percentage target achievement for the 2/3 wheeler category is between 70-89%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr style="background-color:lightgrey;">
                                        <td>If the percentage target achievement for the 2/3 wheeler category is greater than 90%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Petro/OE</td>
                                    <td>For every Petro or OE dealer appointed</td>
                                    <td class="text-right">1000</td>
                                </tr>
                                <tr style="background-color:lightgrey;">
                                    <td>6</td>
                                    <td>New/PTP/Steel Wheel</td>
                                    <td>For every New, PTP or Steel Wheel dealer appointed</td>
                                    <td class="text-right">2000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>SAS</td>
                                    <td>Every % increment in SAS against the year beginning value</td>
                                    <td class="text-right">100</td>
                                </tr>
                                <tr style="background-color:lightgrey;">
                                    <td rowspan="2">8</td>
                                    <td rowspan="2">PJP</td>
                                    <td>If PJP adherence on a daily basis is between 80-89%</td>
                                    <td class="text-right">50</td>
                                </tr>
                                    <tr style="background-color:lightgrey;">
                                        <td>If PJP adherence on a daily basis is between 90-100%</td>
                                        <td class="text-right">100</td>
                                    </tr>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td colspan="3">MSP, SAS & Dealer appointments – No Cap</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        * SAS calculation basis: % = (End of week SAS – Beginning of week SAS)/(Base SAS as on April 1, 2016)
                            
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                   For points to be awarded, current value has to be greater than base value
                            
                                    </td>
                                </tr>
                        </table>
                        <br>
                        
                        
                    </div>
                    <div class="tab-pane" id="3b">
                        <table class="table-condensed table-responsive" width="100%" style="border-radius:5px;">
                            <thead>
                                <tr style="background-color:#6F6F6F;color:white;">
                                    <th>sr</th>
                                    <th>Particular</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="">
                                    <td>1</td>
                                    <td>Mobile-Number</td>
                                    <td>{{$userdata->mobilenumber}}</td>
                                </tr>
                                <tr style="background-color:lightgrey;">
                                    <td>2</td>
                                    <td>Job-Role</td>
                                    <td>{{$userdata->designation}}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Territory</td>
                                    <td>{{$userdata->territory}}</td>
                                </tr>
                                <tr style="background-color:lightgrey;">
                                    <td>4</td>
                                    <td>Region</td>
                                    <td>{{$userdata->region}}</td>
                                </tr>
                            </tbody>
                        </table> 
                          
                            
                    </div>
                </div>
            </div>
            <br><br>


    </body>
</html>