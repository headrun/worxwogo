<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- CSS -->
        <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        @yield('libraryCSS')
        <style>
            
            .glyphicon{
                color:#0096A9;
            }
            @media(max-width:767px){
                h4 {
                font-size: 3.8vw;
                }
                h5{
                font-size: 2.8vw;
                }
                td{
                font-size: 2.4vw;
                }
                label{
                font-weight:400;
                
                }
                
                .progress{
                    margin-left:45px;
                    width:60%;
                    height:30px;
                }
                .progress-text{
                    margin-top:5px;
                    
                }
                .comment{
                    margin-left:40px;
                    font-size: x-small;
                }
                
                .img-circle{
                    margin-top: 14px;
                    width:80%;
                }
                .fa-sign-out{
                    font-size:2.5em!important;
                    padding:4px !importnat;
                    
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
                
                .progress{
                    margin-left:80px;
                    width:60%;
                    height:30px;
                }
                .progress-text{
                    margin-top:5px;
                    
                }
                .comment{
                    margin-left:35px;
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
                
                .progress{
                    margin-left:130px;
                    width:55%;
                    height:30px;
                }
                .progress-text{
                    margin-top:5px;
                    
                }
                .legend2{
                    margin-left:80px;
                }
                .comment{
                    margin-left:40px;
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
                
                .legend2{
                    margin-left:110px;
                }
                .comment{
                    margin-left:50px;
                }
                .progress{
                    margin-left:165px;
                    width:60%;
                    height:30px;
                }
                .progress-text{
                    margin-top:5px;
                    
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
                    min-height: 140px;
                    margin-bottom:0px!important;
                }
            .active{
                color: white;
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

        </script>

        
    </head>
    <body class="" style="background-color:#F0F0F0">
        
        <!-- header -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation"  >
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <label style="color:white;">@yield('pageheading')</label>
                        <h4 class="text-center"><a href="{{url()}}/dashboard/profile" style="color:white;">{{Session::get('name')}}</a>   
                        </h4>
                        <h5 class="text-center"><label style=" border:solid 2px; padding: 5px; border-radius:35%;color:white">Total Points:{{$user->user_points}}</label></h5>
                
                    </div>
                </div>
                <div class="nav navbar-nav navbar-left">
                    <a class="" href="{{url()}}/dashboard/index">
                        <img src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" class="visible-xs " height="63px" width="100px" style="margin-top:0px;border:solid 2px black;position:absolute;"/>
                        <img src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" class="hidden-xs" height="71px" width="175px" style="margin:25px;border:solid 2px black;position:absolute;"/>
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
<div class="container-fluid">
<div class="row leaderboard-toolbar">
    <h4 class="text-center ">{{$client_data['program_name']}}</h4><br>
</div>
</div>
        @yield('content')
        
<!--        
        <div class="row" style="background-color:#00BBD3">
            <div class="col-lg-1 col-md-1 col-sm-1 "></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <button class="btn btn-default btn-lg btn-link" style="font-size:36px;">
                    <span class=" center-block text-center glyphicon glyphicon-home active" ></span>
                </button>
                <span class="badge badge-notify"></span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <button class="btn btn-default btn-lg btn-link" style="font-size:36px;">
                <span class="glyphicon glyphicon-envelope"></span>
                </button>
                <span class="badge badge-notify">6</span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <button class="btn btn-default btn-lg btn-link" style="font-size:36px;">
                <span class="glyphicon glyphicon-comment"></span>
                </button>
                <span class="badge badge-notify">2</span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <button class="btn btn-default btn-lg btn-link" style="font-size:36px;">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                </button>
                <span class="badge badge-notify">3</span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <button class="btn btn-default btn-lg btn-link" style="font-size:36px;">
                <span class="glyphicon glyphicon-certificate"></span>
                </button>
                <span class="badge badge-notify">3</span>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        </div>-->
        @yield('libraryJS')
    </body>
</html>