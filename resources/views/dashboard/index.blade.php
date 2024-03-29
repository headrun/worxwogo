<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <title>Worxogo</title>
  <link rel="manifest" href="/worxogo/manifest.json">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Worxogo">
  <link rel="apple-touch-icon" sizes="512x512" href="/worxogo/images/icons/worxogo.png">
  
  <meta name="msapplication-TileImage" content="/worxogo/images/icons/worxogo.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
  
  
  <link rel="stylesheet" href="{{url()}}/assets/css/inline.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/font-awesome.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/master.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/index.css">
</head>
<body>
  <header class="header">
    
        <!-- header -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation"  >
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <label class="pageheading"></label>
                        <h4 class="text-center"><a href="{{url()}}/dashboard/profile" class="headingname"></a></h4>
                        <h5 class="text-center"><label class="points"></label></h5>
                    </div>
                </div>
                <div class="nav navbar-nav navbar-left">
                    <a class="" href="{{url()}}/dashboard/index">
                        <img src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" class="logo-small " />
                    </a>
                    <label id="lastupdate"><em>Last update: <br class="visible-xs"><span class='lastupdate'></span></em></label>
                </div>
                
                <div class="nav navbar-nav navbar-right text-right">
                    <span >
                    <a class="navbar-right" href="{{url()}}/vault/logout">
                        <i class="fa fa-sign-out text-right signout" aria-hidden="true" >
                        <br>
			<h5 class="dateremaining " >
                             <span class="monthyear"></span>,<br class="visible-xs">
                         Days Left:
                         <span class="daysremaining"> </span>
                        </h5> 
                         
                        </i>
                    </a>
                    </span>
                </div>
            </div>
        </nav>
		<div class="container-fluid">
			<div class="row leaderboard-toolbar">
			<h4 class="text-center toolbar "></h4>
			</div>
		</div>
  </header>

  <main class="main bodydata"  >
    <div class="container-fluid cards" hidden >
       
	
    </div>
  </main>
    
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
    

  <div class="loader">
    <svg viewBox="0 0 32 32" width="32" height="32">
      <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
    </svg>
  </div>

  <!-- Insert link to app.js here -->
  <script> var apiurl= "{{url()}}";</script>
  <script src="{{url()}}/assets/js/jquery.js" ></script>
  <script src="{{url()}}/assets/js/bootstrap.min.js" ></script>
  <script src="{{url()}}/assets/js/dexie.js"></script>
  <script type="text/javascript" src="{{url()}}/assets/js/loader.js"></script>
  <script src="{{url()}}/assets/js/app.js" async ></script>
  
</body>
</html>