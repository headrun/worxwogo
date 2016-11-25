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
.send-likes-btn{
	float: right;
	background-color: #00BBD3;
	color:white;
	margin-right:5px;
}
.send-likes-btn:hover{
	color:#337ab7
}
.previouslike{
	padding:10px 15px 10px 15px;
	margin:10px;
}
.previousmsgphoto{
	float:right;
	font-weight:lighter;
}
.previouslikemsg{

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
</style>

@stop
@section('libraryJS') 
<script>

	var previouslikemsg = document.querySelector('.previouslikemsg').cloneNode(true);
  document.querySelector('.msg-block').appendChild(previouslikemsg);
  var previouslikemsg = document.querySelector('.previouslikemsg').cloneNode(true);
  document.querySelector('.msg-block').appendChild(previouslikemsg);
	var previouslikemsg = document.querySelector('.previouslikemsg').cloneNode(true);
  document.querySelector('.msg-block').appendChild(previouslikemsg);

  $('.openmodal').click(function(){
  	$('#addusermodal').modal({
    	backdrop: 'static',
    	keyboard: false
		});
  });

  $('.footerlikebutton').addClass('active');
  

</script>
@stop


@section('pageHeading')

Send Like

@stop

@section('mainBody')
</br>
<div class="card adduserscard">
	
	<div class=" card-block ">
	 <h4 class="addnames">Names Here</h4>
	 <i class="fa fa-plus-circle fa-2x btn openmodal" data-backdrop="static" data-keyboard="false" aria-hidden="true"></i>
	</div>
	
</div>


<div class="msgbox">
	<div class="row text">
		
		<div class="form-group">
  		<textarea class="form-control" rows="5" id="liketext" placeholder="Say Something"></textarea>
  		<br>
  		<button class="send-likes-btn btn  btn-sm" >Send <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
		</div>

	</div>
</div>

<h5 class="previouslike">Previous Likes</h5>
	<!--Card-->
  <div class="card" title="">
    <!--Card content-->
    <div class="card-block msg-block">
        

    </div>
    <!--/.Card content-->

  </div>
  <!--/.Card-->		

	<!-- Modal -->
  <div class="modal fade" id="addusermodal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Users</h4>
        </div>
        <div class="modal-body">
          <p>Users Here.</p>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-primary addusers">Add Users</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>


@stop

@section('extra')
<previouslikemsg hidden>
	<div class="row previouslikemsg">	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<label class="previousmsgphoto">Image here</label>	
		</div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
			<label>Great Job on New Dealer appointment</label>
			<br>
			<em class="datedata">yesterday,12.46pm</em>
			<br>

		</div>
		<div class="previouslikeborder"></div>
	</div>
</previouslikemsg>
@stop