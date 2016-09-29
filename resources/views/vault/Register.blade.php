<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Register</title>
      <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
      <!-- CSS -->
      <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{url()}}/assets/spinners/mk-spinners.css">
      <link rel="stylesheet" href="{{url()}}/assets/css/register.css">
      <!-- JS -->
      <script>var jqueryurl="{{url()}}";</script>
      <script src="{{url()}}/assets/js/jquery.js"></script>
      <script src="{{url()}}/assets/js/bootstrap.min.js"></script>
   </head>
   <body class="container-fluid" >
      <div id ="preloader" class="modal">
         <div class="mk-spinner-centered mk-spinner-ring"></div>
      </div>
      <div class="row" >
         <div class=" col-lg-4 col-md-4  col-sm-8 col-xs-8 login-box center-block text-center">
            <div>
               <img class="clientlogo" src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" ></img>
            </div>
            <h4 class="typeheading"><span class="login" >Login</span> / <span class="register" >Register</span></h4>
            {!! Form::open(array('url' => '/login', 'id'=>"loginForm", "class"=>"", 'method' => 'post')) !!}
            {!! csrf_field() !!}
            <div class="mobilenodiv">
               <input type="text" class="form-control" placeholder="Mobile Number" name="mobileNumber" id="mobileNumber" id="inputError"  
                  maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off"
                  onfocus="this.removeAttribute('readonly');" readonly />
               <span class="glyphicon glyphicon-warning-sign form-control-feedback remove" ></span>
               <br>
            </div>
             
            <div class="passworddiv">
               
               <input type="password" class="form-control password" placeholder="Password" name="password" 
                  id="password" autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly >
               <span class="glyphicon glyphicon-warning-sign form-control-feedback passremove"></span>
               <br>
            </div>
            
            <div class="confirmpassworddiv" >
               
              
                  <input type="password" class="form-control password" placeholder="Confirm Password" name="confirmpassword" 
                     id="confirmpassword" autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly>
                  <span class="glyphicon glyphicon-warning-sign form-control-feedback confirmpassremove" ></span>
              <br>
            </div>
            <div class="otpdiv">
                
                  <input type="password" class="form-control password" placeholder="Enter OTP " name="otppassword" 
                     id="otppassword" autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly>
                  <span class="glyphicon glyphicon-warning-sign form-control-feedback otppassremove" ></span>
                  
            </div>
            
            <input type="hidden" value="{{$client_data['id']}}" name="client_id" id="client_id"/>
            <div id="sessionerror" class=" control-group error text-center" > 
               @if (Session::has('message'))
               {{ Session::get('message') }}
               @endif
            </div>
            <div id="errormsg" class="errormsg control-group error text-left" > </div>
            <div id="ajaxmsg" class="errormsg control-group error text-center" > </div>
            <br>
            <button  type="submit" class=" btn-submit btn btn-warning form-control">Log In</button>
            <div class="resendotpdiv">
                <br>
                <button type="submit" class=" btn btn-warning form-control resendotp">Resend OTP</button>
            </div>
            <h5 class="forgotpassword"><a href='#'class="forgotpasslink" >Forgot Password ? <br class="visible-xs"> Click Here</a></h5>
            {!! Form::close() !!}
            <br>
            <div>
               <img  class="logo2" src="{{url()}}/assets/img/worxwogo.png"/>
            </div>
            <br>
            <small>&copy; 2016 worxwogo. All Rights Reserved</small>
         </div>
      </div>
      <!-- JS -->
      <script src="{{url()}}/assets/js/register.js"></script>
      <script>
          /*
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
         
         ga('create', 'UA-71192393-4', 'auto');
         ga('send', 'pageview');
         */
      </script>
   </body>
</html>