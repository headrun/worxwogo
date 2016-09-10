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
    </head>
    <body class="container-fluid">
        
        <div class="row">
            <div class=" col-lg-4 col-md-4  col-sm-8 col-xs-8 login-box center-block text-center" 
                style=" margin-top: 10%; float: none !important;" >
            
                <img src="{{url()}}/assets/img/worxwogo.png"></img>
            <br>
            <br><br>
            
            {!! Form::open(array('url' => '/vault/adminlogin', 'id'=>"adminLoginForm", "class"=>"", 'method' => 'post')) !!}
            {!! csrf_field() !!}
            
            <input type="email" class="form-control" placeholder="e-Mail" name="email" required />
            <br>
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <br>
            <button  type="submit" class=" btn btn-warning form-control"> Login</button>
            
            {!! Form::close() !!}
            
            
            <br><br>
            <small>&copy; 2016 worxwogo. All Rights Reserved</small>
            </div> 
        </div>
    </body>
    
</html>