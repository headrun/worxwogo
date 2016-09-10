@extends('layout.adminmaster')

@section('libraryCSS')


@stop


@section('libraryJS')
<script>
$(document).ready(function(){
    
    $.fn.serializefiles = function() {
    var obj = $(this);
    /* ADD FILE TO PARAM AJAX */
    var formData = new FormData();
    $.each($(obj).find("input[type='file']"), function(i, tag) {
        $.each($(tag)[0].files, function(i, file) {
            formData.append(tag.name, file);
        });
    });
    formData.append('client', $('#client').val());
    var params = $(obj).serializeArray();
    $.each(params, function (i, val) {
        formData.append(val.name, val.value);
    });
    return formData;
};


    $('#uploadform').submit(function(event){
        event.preventDefault();
        var fileExtension = ['xls', 'xlsx', 'csv'];
        if( ($('#client').val()!=="") && ($('#uploadType').val()!=="") && ($('#uploadextract').val()!=="")){
            $('.msgdiv').empty();
            if ($.inArray($('#uploadextract').val().split('.').pop().toLowerCase(), fileExtension) === -1) {
                $('.msgdiv').html("<p class='uk-alert uk-alert-warning'>please select proper file (Allowerd only xls, xlsx, csv) </p>");
            }else{
                $('.msgdiv').html("<p class='uk-alert uk-alert-warning'>please wait processing</p>");
                            
                $.ajax({
			type: "POST",
			url: "{{URL::to('/quick/uploaddata')}}",
                        data: $('#uploadform').serializefiles(),
                        cache: false,
                        contentType: false,
                        processData: false,
			dataType: 'json',
			success: function(response){
                            console.log(response);
                            if(response.status==='success'){
                            $('.msgdiv').html("<p class='uk-alert uk-alert-success'>"+response.status+"</p>");
                            }else{
                                $('.msgdiv').html("<p class='uk-alert uk-alert-danger'>"+response.status+' '+
                                                   response.type+"</p>");
                            }
                        }
                });
            }
        }else{
            $('.msgdiv').html("<p class='uk-alert uk-alert-warning'>Please select all required fields to continue </p>");
        }
       
    });
});

</script>
@stop


@section('content')
<div id="breadcrumb">
	<ul class="crumbs">
		<li class="first"><a href="{{url()}}/admindashboard/index" style="z-index:9;"><span></span>Home</a></li>
		<li ><a href="#" style="z-index:8;"><span></span>Data Uploads </a></li>
		
	</ul>
</div>
<br clear="all"/>
<br clear="all"/>
<div class="row">
    <form  class="form-inline" id="uploadform" action="" enctype="multipart/form-data" method="post">
    {!! csrf_field() !!}
    <div class="md-card">
        <div class="md-card-content large-padding">
            <div class="row">
                <div class="msgdiv"></div>
                <br>
                <div class="uk-grid" data-uk-grid-margin >
                    <div class="uk-width-medium-1-3">    
                        <select name="client" id="client" class="input-sm md-input"
                            style='padding: 0px; font-weight: bold; color: #727272;float:right '>
                            <option value="" selected>Please select the Company</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->client_name}}</option>
                            @endforeach
                         </select>
                    </div>
                    <div class="uk-width-medium-1-3">
                        <select name="uploadType" id="uploadType" class="input-sm md-input"
                            style='padding: 0px; font-weight: bold; color: #727272;float:right '>
                            <option value="" selected>Please select Upload Extract</option>
                            <option value="objectivelist" >Objectives List</option>
                            <option value="userextract" >User Extract</option>
                            <option value="objectiveextract" >Objective Extract</option>
                            <option value="badgesextract" >Badges Extract</option>
                            <option value="leaderboardextract" >Leaderboard Extract</option>
                         </select>
                    </div>
                    <div class="uk-width-medium-1-3">    
                        <div class="parsley-row">
                        <input type="file" name="uploadextract" id="uploadextract" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3">
                        <button type="submit" class="md-btn md-btn-primary">Upload Data</button>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>



@stop