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
                        <label style="color:white;"></label>
                        <h4 class="text-center"><a href="{{url()}}/dashboard/profile" style="color:white;">Profile Info</a>   
                        </h4>
                        
                    </div>
                </div>
                <div class="nav navbar-nav navbar-left">
                    <a class="" href="{{url()}}/dashboard/index">
                        <img src="{{url()}}/assets/img/tvs.jpg" class="visible-xs " height="63px" width="100px" style="margin-top:0px;border:solid 2px black;position:absolute;border-radius:50%;"/>
                        <img src="{{url()}}/assets/img/tvs.jpg" class="hidden-xs" height="71px" width="175px" style="margin:25px;border:solid 2px black;position:absolute;border-radius:50%;"/>
                    </a>
                    <label id="lastupdate" style="color:white"><em>Last update: <br class="visible-xs">{{ date('M Y d')}} </em></label>
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


        <!-- header -->

        
        
        <br>
        
        
        <h4 class="text-center">{{$userdata->name}}</h4>
            <div id="exTab3" class="container">	
                <ul  class="nav nav-pills">
                    <li class="active">
                        <a  class="link" href="#1b" data-toggle="tab"><h5>Badges</h5></a>
                    </li>
                    <li><a class="link" href="#2b" data-toggle="tab"><h5>Points</h5></a>
                    </li>
                    <li><a class="link" href="#3b" data-toggle="tab"><h5>Profile</h5></a>
                    </li>
                </ul>

		<div class="tab-content clearfix">
                    <div class="tab-pane active" id="1b">
                        <h4>Badges Here</h4>
                    </div>
                    <div class="tab-pane" id="2b">
                        <h4>Points:{{$userdata->user_points}}</h4>
                    </div>
                    <div class="tab-pane" id="3b">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-10 center-block" style=" margin-top: 10px;; float: none !important;">
            
                            {!! Form::open(array('url' => 'Userupdate', 'id'=>"updateprofileForm", "class"=>"", 'method' => 'post')) !!}
                            {!! csrf_field() !!}
                
                
                           
                            <label>Mobile-Number:</label>{{$userdata->mobilenumber}}
                            <!--<input type="text" class="form-control" placeholder="Mobile Number" name="mobileNumber" required 
                            maxlength="10" minlength="10"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                            value="{{$userdata->mobilenumber}}"/>
                            -->
                            
                            <br>
                
                            <label>Job-Role:</label>{{$userdata->designation}}
                            <!--<input type="text" value="{{$userdata->designation}}" class="form-control" required/>-->
                            <br>
                
                            <label>Territory:</label>{{$userdata->territory}}
                            <!--<input type="text" value="{{$userdata->location_name}}" class="form-control" required>-->
                            <br>
                            
                            <label>Region:</label>{{$userdata->region}}
                            <!--<input type="text" value="{{$userdata->branch}}" class="form-control" required>-->
                            <br>
                
                            
                            <!--<button  type="submit" class=" btn btn-warning form-control">Update Profile</button>-->
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        


    </body>
</html>