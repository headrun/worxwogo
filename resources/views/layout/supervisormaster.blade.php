<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <title>Worxogo</title>
  <link rel="stylesheet" href="{{url()}}/assets/css/supervisorinline.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/supervisordashboard.css">
  @yield('libraryCSS')
</head>
<body>
  
  <header class="header">
    <!-- header -->
        
    <nav class="navbar navbar-default navbar-static-top" role="navigation"  >
      <div class="container-fluid">
        

        <div class="navbar-header pull-left">
          
          <a class="" href="{{url()}}/dashboard/supervisorindex">
             <img class="logo-brand" src="{{url()}}/assets/img/logo.png"/>
          </a>
          
        </div>


        <div class="nav navbar-nav navbar-left">
          <h1 class="heading">@yield('pageHeading')</h1>
        </div>

        
        
        <div class="nav navbar-nav navbar-right ">
          
          

          <a  class="signoutbtn" href="{{url()}}/vault/logout"><i class="fa fa-sign-out text-right fa-4x" aria-hidden="true" ></i></a>
         <!-- <img class="logo-brand" src="{{url()}}/assets/avatars/user.png"/>-->
        </div>


      </div>
    </nav>

  </header>
  
  <main class="main bodydata"  >
      @yield ('SupervisorProfileToolbar')
        @section('navbarName')
          <div class="supprofilenavbar center-block text-center">
            <a href="{{url()}}/dashboard/supprofile"><h4 class="username toolbarname" style="display:inline-block;"><i class="fa fa-user-o" aria-hidden="true"></i> &nbsp;{{Session::get('name')}}</h4></a>
          </div>

          @stop

          @yield('navbarName')
      @yield('toolbar')
    <div class="container-fluid cards"  >
      @yield('mainBody')
    
    </div>
    <div class="" style="height:60px;"></div>
    
  </main>

  @yield('extra')

  


  <footer class="navbar-fixed-bottom">
  <div class="container-fluid footer">
  <div class="row">
    <a class="footerbuttonclick" href="{{url()}}/dashboard/supervisorindex">
    <div class="col-lg-3 col-md-3  col-sm-3 col-xs-3 footerbutton center-block text-center">
      <i class="fa fa-home fa-3x footerdashboard" aria-hidden="true"></i>
    </div>
    </a>
    <a class="footerbuttonclick" href="{{url()}}/dashboard/sendmsg">
    <div class="col-lg-3 col-md-3  col-sm-3 col-xs-3 footerbutton center-block text-center">
      <i class="fa fa-envelope-open fa-3x footermsgbutton" aria-hidden="true"></i>
    </div>
    </a>
    <!--
    <a href="sendmsg">
    <div class="col-lg-2 col-md-2  col-sm-2 col-xs-2 footerbutton center-block text-center">
      <i class="fa fa-comment fa-3x " aria-hidden="true"></i>
    </div>
    </a>
    -->
    <a class="footerbuttonclick" href="{{url()}}/dashboard/sendlike">
    <div class="col-lg-3 col-md-3  col-sm-3 col-xs-3 footerbutton center-block text-center">
      <i class="fa fa-thumbs-up fa-3x footerlikebutton" aria-hidden="true"></i>
    </div>
    </a>
    <a class="footerbuttonclick" href="{{url()}}/dashboard/supervisorleaderboard ">
    <div class="col-lg-3 col-md-3  col-sm-3 col-xs-3 footerbutton center-block text-center">
      <i class="fa fa-certificate fa-3x footerleaderboardbutton" aria-hidden="true"></i>
    </div>
    </a>
  </div>
  </div>  
  </footer>


  <div class="loader" hidden>
    <svg viewBox="0 0 32 32" width="32" height="32">
      <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
    </svg>
  </div>


  <script> var apiurl= "{{url()}}";</script>
  <script src="{{url()}}/assets/js/jquery.js" ></script>
  <script src="{{url()}}/assets/js/bootstrap.min.js" ></script>
  <script>
    $('.footerbuttonclick').click(function(){
      $('.loader').removeAttr('hidden');
      $('.loader').show();
    });
    $('signoutbtn').click(function(){
      $('.loader').removeAttr('hidden');
      $('.loader').show();
    })
  </script>
  @yield('libraryJS') 
</body>
</html>
