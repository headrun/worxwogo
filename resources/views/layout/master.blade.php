<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <title>Worxogo</title>
        <!-- CSS -->
                <link rel="stylesheet" href="{{url()}}/assets/spinners/mk-spinners.css">

        <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{url()}}/assets/css/master.css">
        @yield('libraryCSS')
        
        <!-- JS -->
        <script src="{{url()}}/assets/js/jquery.js"></script>
        <script src="{{url()}}/assets/js/bootstrap.min.js"></script>
<script>
  /*  
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71192393-4', 'auto');
  ga('set', 'userid', "{{Session::get('empId')}}");
  ga('set', 'userId', "{{Session::get('empId')}}");
  ga('set', 'dimension1', "{{Session::get('empId')}}");
  ga('send', 'pageview');
  */
  
$(window).on('load', function() {
                
                $('#preloader').modal({backdrop: 'static', keyboard: false});
                
                setTimeout(function(){
                    $("#preloader").fadeOut(function(){
                        $('.modal-backdrop.in').css('opacity','0');
                        $('#preloader').modal('hide');
                    });
                },200);
                
});
</script>

        
    </head>
    <body class="bodydata">
        
        <!-- header -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation"  >
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <label class="pageheading">@yield('pageheading')</label>
                        <h4 class="text-center"><a href="{{url()}}/dashboard/profile" class="headingname" >{{Session::get('name')}}</a>   
                        </h4>
                        <h5 class="text-center"><label class="points">Total Points:{{$user->user_points}}</label></h5>
                
                    </div>
                </div>
                <div class="nav navbar-nav navbar-left">
                    <a class="" href="{{url()}}/dashboard/index">
                        <img src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" class="visible-xs logo-small" height="55px" width="90px" />
                        <img src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" class="hidden-xs logo-big" height="71px" width="175px" />
                    </a>
                    <label id="lastupdate"><em>Last update: <br class="visible-xs">{{ date('d-m-Y',strtotime($client_last_updated['created_at']))}} </em></label>
                </div>
                
                <div class="nav navbar-nav navbar-right text-right">
                    <span >
                    <a class="navbar-right" href="{{url()}}/vault/logout">
                        <i class="fa fa-sign-out text-right signout" aria-hidden="true" >
                         <br>
                         <h4 class="dateremaining">
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
        
        <div id ="preloader" class="modal">
            <div class="mk-spinner-centered mk-spinner-ring"></div>
        </div>
        
<div class="container-fluid">
<div class="row leaderboard-toolbar">
    <h4 class="text-center ">{{$client_data['program_name']}}</h4><br>
</div>
</div>
        @yield('content')
        @yield('libraryJS')
    </body>
</html>