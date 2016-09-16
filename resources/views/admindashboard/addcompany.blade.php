@extends('layout.adminmaster')

@section('libraryCSS')
<style> 
    
</style>

@stop

@section('libraryJS')
<script>
function editclient(id,name,status,programname){
       $('.modal-dialog').removeClass('modal-sm');
       $('.modal-dialog').addClass('modal-md');
       $('.modal-title').html("Edit Client Data");
       $('.modal-body').empty();
       $('.modal-body').html("<div class='msg' style='padding:1px;'></div><label style='width:50%'>Client Name</label><label style='width:50%'>Status</label><input type='text' class='form-control clientname' style='width:50%;display:inline-block;padding:5px;' value='"+name+"'/>"+
                             "<select class='form-control status' style='padding:5px;width:50%;display:inline-block' value='"+status+"'>"+
                             " <option value='A'>Active</option>"+
                             "<option value='N'>Inactive</option>"+
                             "</select><br><label style='width:100%'>Program Name</label><input type='text' class='form-control programName' style='width:100%;display:inline-block;padding:5px;' value='"+programname+"'/>");
       $('.status').val(status);
       $('.modal-footer').html("<center><button class='btn btn-primary edit'>Save</button><button class='btn' data-dismiss='modal'>Cancel</button></center>");
       $('#delete').modal('show');
       $('.edit').click(function(){
           console.log('edit');
            $.ajax({
			type: "POST",
                        url: "{{URL::to('/quick/editCompanyById')}}",
                        data: {'company_id':id,'company_name':$('.clientname').val(),'status':$('.status').val(),'program_name':$('.programName').val()},
			dataType: 'json',
			success: function(response){
                            //console.log(response);
                                 if(response.status==='success'){
                                     $('.msg').addClass('btn-success');
                                     $('.msg').html("<h4> Success</h4>");
                                     setTimeout(function(){
                                        window.location.reload(1);
                                     }, 1000);
                                 }else{
                                     $('.msg').addClass('btn-danger');
                                     $('.msg').html("<h4> Failure</h4>");
                                 }
                        }
            });
        });
   } 
    
    function deletecompany(id){
        $('.modal-dialog').removeClass('modal-md');
        $('.modal-dialog').addClass('modal-sm');
        $('.modal-title').html("Confirm Delete");
        $('.modal-body').html("Do you really want to delete this ?");
        $('.modal-footer').html("<center><button class='btn btn-primary delete'>Yes</button><button class='btn ' data-dismiss='modal'>No</button></center>")
        $('#delete_id').val(id);
        $('#delete').modal('show');
        $('.delete').click(function(){
            console.log('delete');
            $.ajax({
			type: "POST",
                        url: "{{URL::to('/quick/deleteCompanyById')}}",
                        data: {'delete_id':id},
			dataType: 'json',
			success: function(response){
                            //console.log(response);
                                 if(response.status==='success'){   
				   window.location.reload(1);
                                 }
                        }
            });
        });
    }
    
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
    formData.append('company_name', $('#companyName').val());
    formData.append('program_name', $('#programName').val());
    formData.append('status', $('#formstatus').val());
    var params = $(obj).serializeArray();
    $.each(params, function (i, val) {
        formData.append(val.name, val.value);
    });
    return formData;
    };

    
    $('#uploadform').submit(function(e){
         var fileExtension = ['png', 'jpg'];
        e.preventDefault();
        if ($.inArray($('#uploadextract').val().split('.').pop().toLowerCase(), fileExtension) === -1) {
            $('.msgdiv').html("<p class='uk-alert uk-alert-warning'>please select proper file (Allowerd only jpg, png) </p>");
        }else{
             $('#addclient').attr('disabled','disabled');
        $.ajax({
			type: "POST",
                        url: "{{URL::to('/quick/addClient')}}",
                        data: $('#uploadform').serializefiles(),
                        cache: false,
                        contentType: false,
                        processData: false,
			dataType: 'json',
			success: function(response){
                                 if(response.status==='success'){   
				    window.location.reload(1);
                                 }
                        }
            });
        }
    });
    });
    
</script>
@stop


@section('content')

<div id="breadcrumb">
	<ul class="crumbs">
		<li class="first"><a href="{{url()}}/admindashboard/index" style="z-index:9;"><span></span>Home</a></li>
		<li ><a href="#" style="z-index:8;"><span></span>Add Company </a></li>
		
	</ul>
</div>
<br clear="all"/>
<br clear="all"/>
    
<div class="md-card">
    <div class="md-card-content large-padding">
        <form   id="uploadform" action="" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="msgdiv"></div>
            <br>
            <div class="uk-grid" data-uk-grid-margin >
                <div class="uk-width-medium-1-3">  
                    <div class="parsley-row form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" name="companyName"  id="companyName" class="form-control input-sm md-input" required/>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="parsley-row form-group">
                        <select class=" input-sm md-input" name="formstatus" id="formstatus" style="padding:0px; font-weight:bold;color: #727272;" required>
                            <option value="">please select status</option>
                            <option value="A">Active</option>
                            <option value="N">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="parsley-row">
                        <input type="file" name="uploadextract" id="uploadextract" class="form-control" required>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="parsley-row">
                        <label for="programName">Program Name</label>
                        <input type="text" name="programName"  id="programName" class="form-control input-sm md-input" required/>
                    </div>
                </div>
                <br clear="all">
                <div class="uk-width-medium-1-1">
                    <div class="parsley-row form-group">
                        <button type="submit" id="addclient" class="md-btn md-btn-primary">Add New Company</button>
                    </div>
                </div>
            </div>
        </div>
</form>

        <br>
        <br>
        <div class="row">
            <table  class="table table-striped" style="background-color:#fff; border-radius:5px; ">
                <thead>
                    <tr>
                    <th>Name of the Company</th>
                    <th>Program Name</th>
                    <th>No of Users</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
            <tbody>
            <?php for($i=0;$i<count($clients_data);$i++){ ?>
            <tr><td>{{$clients_data[$i]['client_name']}}</td>
                <td>{{$clients_data[$i]['program_name']}}</td>
                <td>{{$clients_data[$i]['totalusers']}}</td>
                <td><?php if($clients_data[$i]['status']=='A'){echo" Active";}else if($clients_data[$i]['status']=='N'){echo "Inactive";} ?></td>
                <td><button class="btn btn-warning btn-xs" onclick="editclient({{$clients_data[$i]['id']}},'{{$clients_data[$i]['client_name']}}','{{$clients_data[$i]['status']}}','{{$clients_data[$i]['program_name']}}')">
                    <i class="fa fa-pencil" aria-hidden="true">&nbsp;</i> Edit</button>
                    <?php if($clients_data[$i]['totalusers']==0){ ?>
                    <button class="btn btn-danger btn-xs" onclick="deletecompany({{$clients_data[$i]['id']}})">
                    <i class="fa fa-trash" aria-hidden="true">&nbsp;</i> Delete</button>        
                
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
    

 <!-- Modal -->
  <div class="modal fade" id="delete" role="dialog" style="margin-top: 50px; z-index: 99999;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#337ab7; color:white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="deletepriceheader" id='deletepriceheader'>
                <h4 class="modal-title">Confirm Delete</h4>
            </div>
        </div>
        <div class="modal-body deletebody" id='deletebody'>
          <p>Do you really want to delete this ?</p>
          <input type="hidden" id="delete_id" value="" />
        </div>
        <div class="modal-footer deletefooter" id='deletefooter'>
          <center>
          <button type="button" class="btn btn-primary" id='deletebtn' >Yes</button>
          <button type="button" class="btn btn-default" id="nobtn" data-dismiss="modal">No</button>
          </center>
        </div>
      </div>
    </div>
  </div>

@stop