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
  <link rel="apple-touch-icon" href="/worxogo/images/icons/worxogo.png">
  <meta name="msapplication-TileImage" content="/worxogo/images/icons/worxogo.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
  
  
  <link rel="stylesheet" href="{{url()}}/assets/css/inline.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/font-awesome.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/master.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/leaderboard.css">
</head>
<body class="bodydata">
  <header class="header">
    
        <!-- header -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation"  >
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <label class="pageheading">Objectives <br class="visible-xs">Leaderboard</label>
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
                        <br>
			</div>
		</div>
  </header>

  <main class="main bodydata"  >
    <div class="container-fluid cards" hidden >
        
<div  class="row region" >
    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6 center-block text-center objective-name " >
      <h5>Leaderboard :  {{Session::get('region')}}</h5>
    </div>
</div>
       
    </div>
    <table class="table" >
        <thead> 
            <tr>
                <td class="name">
                    <h4 class="trdata">Rank</h4>
                </td>
                <td class="name">
                    <h4 class="trdata">Name</h4>
                </td>
                <td class="name">
                    <h4 class="trdata">Territory</h4>
                </td>
                <td class="name">
                    <h4 class="text-right trdata">Points</h4>
                </td>
            </tr>
        </thead>
	
        </table>
  </main>
    
  
  
  
  <div class="loader">
    <svg viewBox="0 0 32 32" width="32" height="32">
      <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
    </svg>
  </div>

  <!-- Insert link to app.js here -->
  <script> var apiurl= "{{url()}}";</script>
  <script src="{{url()}}/assets/js/jquery.js" ></script>
  <script src="{{url()}}/assets/js/bootstrap.min.js" ></script>
  <script type="text/javascript" src="{{url()}}/assets/js/loader.js"></script>
  <script src="{{url()}}/assets/js/leaderboard.js" async ></script>
  
</body>
</html>