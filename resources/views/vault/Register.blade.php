<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- CSS -->
        <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
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
    <body class="container-fluid">
        
        <div class="row">
            <div class=" col-lg-4 col-md-4  col-sm-8 col-xs-8 login-box center-block text-center" 
                style=" margin-top: 10%; float: none !important;" >
                <div>
                    <img src="{{url()}}/assets/img/logo/jktyre.jpg" style="height:76px; width:226px;"></img>
                </div>
            <br>
                
            {!! Form::open(array('url' => '/vault/Register', 'id'=>"registerloginForm", "class"=>"", 'method' => 'post')) !!}
            {!! csrf_field() !!}
            <div >
            <input type="text" class="form-control" placeholder="Mobile Number" name="mobileNumber" id="mobileNumber" id="inputError"  
                   maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" />
            <span class="glyphicon glyphicon-warning-sign form-control-feedback remove" style="display: none;"></span>
            </div>
            <div id="errormsg" class="errormsg control-group error" style="font-size:12px; color:red;"> </div>
            <br>
            <button  type="submit" class=" btn btn-warning form-control">Register / Login</button>
            
            {!! Form::close() !!}
                
            <br>
            <div>
            <img src="{{url()}}/assets/img/worxwogo.png"/>
            </div>
            <br>
            <small>&copy; 2016 worxwogo. All Rights Reserved</small>
            </div> 
        </div>
        
        
        <script>
            var errors="";
            $('#registerloginForm').submit(function(event){
                errors="";
                if($('#mobileNumber').val().length != '10'){
                    event.preventDefault();
                    errors="*Enter a valid 10 digit mobile number without leading zeroes or country code"; 
                    $('#errormsg').html(errors);
                    $('#mobileNumber').parent().addClass('has-error');
                    $('#mobileNumber').parent().addClass('has-feedback');
                    $('.remove').css("display","block");
                }
                
            });
            
            $('#mobileNumber').keyup(function(){
                if($('#mobileNumber').val().length == '10'){
                    $('#mobileNumber').parent().removeClass('has-error');
                    $('#mobileNumber').parent().removeClass('has-feedback');
                    $('.remove').css("display","none");
                    $('#errormsg').empty();
                }
            });
        </script>
    </body>
    
</html>