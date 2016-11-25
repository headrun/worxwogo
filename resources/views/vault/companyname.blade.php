<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Company name</title>
      <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
      <!-- CSS -->
      <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
      <script src="{{url()}}/assets/js/jquery.js"></script>
      <script src="{{url()}}/assets/js/bootstrap.min.js"></script>
   </head>
   <body class="container-fluid" >
       <div class="row"  style="margin-top:15%">
           <div class=" col-lg-4 col-md-4  col-sm-8 col-xs-8  center-block text-center" style="float:none;">
               <input type="text" class="form-control cmpname" placeholder="Company Name Here" id="cmpname" >
               <br>
               <button type="btn" class="btn btn-warning form-control"   id="btnclick">Enter Login Page</button>
           </div>
        </div>
   </body>
   <script>
       $('#btnclick').click(function(){
           //e.preventDefault();
           location.assign('{{url()}}'+'/'+$('#cmpname').val());
       });    
       
   </script>
</html>