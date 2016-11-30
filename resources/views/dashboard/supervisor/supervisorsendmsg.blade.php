@extends('layout.supervisormaster')

@section('libraryCSS')

<style>
.addusersbox {
	
	background-color: white;
	border-radius:5px;
}
.fa-plus-circle{
	float:right;
	color:slategrey;
}
.addnames{
	display:inline-block;
}
.send-msg-btn{
	float: right;
	background-color: #00BBD3;
	color:white;
	margin-right:5px;
}
.send-msg-btn:hover{
	color:#337ab7
}
.previous{
	padding:10px 15px 10px 15px;
	margin:10px;
}
.previousmsgphoto{
	float:right;
	font-weight:lighter;
}
.previousmsg{

	border-bottom:2px solid #f5f5f5;
	border-radius: 5%;
	margin-top:10px;
}
.datedata{
	font-size: smaller;
	margin-bottom: 5px;
}
.addusers{
	background-color:#00BBD3;
	border-color: #adadad;
}

.adduserscard{
	border:none;
	box-shadow:none;
}
.charcount{
	color:gray;
	font-size: 12px;
}
</style>


@stop

@section('libraryJS') 
<script>

	var previousmsg = document.querySelector('.previousmsg').cloneNode(true);
  document.querySelector('.msg-block').appendChild(previousmsg);
  var previousmsg = document.querySelector('.previousmsg').cloneNode(true);
  document.querySelector('.msg-block').appendChild(previousmsg);
	var previousmsg = document.querySelector('.previousmsg').cloneNode(true);
  document.querySelector('.msg-block').appendChild(previousmsg);

  $('.openmodal').click(function(){
  	$('#addusermodal').modal({
    	backdrop: 'static',
    	keyboard: false
		});
  });

  $('.footermsgbutton').addClass('active');

//events
  
  $('.msg').keyup(function(){
  		if(($('.msg').val()).length > 100){
  			$('.charcount').css('color','red');
  			$('.charcount').html('100 characters exceeded !');
  			$('.charcountlabel').hide();
  			$('.send-msg-btn').addClass('disabled');

  		}else{
  			$('.charcount').html('Characters Left:<span class="charcountlabel"></span>' );
  			$('.charcount').css('color','gray');
  			$('.charcountlabel').html(100-($('.msg').val()).length);
  			$('.send-msg-btn').removeClass('disabled');
  		}

      if(($('.msg').val()).length ==0){
        $('.send-msg-btn').addClass('disabled');        
      }
  });

  $('.send-msg-btn').click(function(){
    console.log('sending');
  	$.ajax({
		  type: "POST",
		  url: "{{URL::to('/quick/sendtextmsg')}}",
      data: {'emp_id':$('.select_emp').val(),'msg':$('.msg').val()},
		  dataType: 'json',
		  success: function(response){
        console.log(response);
      }
    });
  });


</script>
@stop

@section('pageHeading')
Send Message
@stop

@section('mainBody')

</br>
<div class="card adduserscard">
	
	<div class=" card-block ">
	<em>Select User</em>
	<select class="form-control select_emp">
		@foreach($emp_list as $emp)
			<option value="{{$emp->emp_code}}">{{$emp->name}}</option>
		@endforeach
	</select>
	<!--
	 <div class=" obj_dropdowndiv  dropdown">
            <?php for($i=0;$i<count($emp_list);$i++){ 
            if($i==0){
            ?>
            <button class="btn btn-default dropdown-toggle" value="{{$emp_list[$i]['emp_code']}}" type="button" data-toggle="dropdown" style="width:100%">
            {{$emp_list[$i]['name']}}
            <span class="caret text-right"></span>
            </button>
            <ul class="dropdown-menu" style="width:100%">
            <?php }else{?>
            	<li value="{{$emp_list[$i]['emp_code']}}"><a href="#">{{$emp_list[$i]['name']}}</a></li>
            <?php }
            }
            ?>

			</ul>
	-->
	</div>
	
</div>


<div class="msgbox">
	<div class="row text">
		
		<div class="form-group">
  		<textarea class="form-control msg" rows="3" id="liketext" placeholder="Say Something" ></textarea>
  		<p class="charcount center-block text-center">Characters Left: <span class="charcountlabel">100</span></p>
  		<button class="send-msg-btn btn  btn-sm disabled" >Send <i class="fa fa-envelope-open" aria-hidden="true"></i></button>
		</div>

	</div>
</div>

<h5 class="previousmsgmsg">Previous Messages</h5>
	<!--Card-->
  <div class="card" title="">
    <!--Card content-->
    <div class="card-block msg-block">
        

    </div>
    <!--/.Card content-->

  </div>
  <!--/.Card-->		

	

@stop

@section('extra')
<previousmsg hidden>
	<div class="row previousmsg">	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<label class="previousmsgphoto">Image here</label>	
		</div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
			<label>Great Job on New Dealer appointment</label>
			<br>
			<em class="datedata">yesterday,12.46pm</em>
			<br>

		</div>
		<div class="previousmsgborder"></div>
	</div>
</previousmsg>
@stop
