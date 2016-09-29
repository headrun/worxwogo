@extends('layout.adminmaster')

@section('libraryCSS')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
	

@stop


@section('libraryJS')
 <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js">
	</script>
  

<script>
    var jq = $.noConflict();
    $(document).ready(function(){
        $( "#startdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#enddate" ).datepicker({ dateFormat: 'yy-mm-dd' });
//        $("#reporttype").prop('disabled', 'disabled');
//        $('#startdate').prop('disabled', 'disabled');
//        $('#enddate').prop('disabled', 'disabled');
//        
        
        
        var data='';
        jq('#generatereport').click(function(){
            jq.ajax({
                type: "POST",
                url: "{{URL::to('/quick/getreportdata')}}",
                data: {'company_id':$('#client').val(),'report_type':$('#reporttype').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val()},
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(response.status==='success'){
                        if(response.type==='summaryreport'){
                         data="";
                         data+='<table class="uk-table" id="followupTable" >'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="uk-text-nowrap"> upload id </th>'+
                                            '<th class="uk-text-nowrap">Extract Type</th>'+
                                            '<th class="uk-text-nowrap">Status</th>'+
                                            '<th class="uk-text-nowrap">uploaded date</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                            for (var i=0;i<response.data.length;i++){
                                data+="<tr><td>"+response.data[i]['id']+"</td><td>"+response.data[i]['insert_table']+"</td><td>"+response.data[i]['status']+"</td><td>"+response.data[i]['created_at']+"</td></tr>";
                            }
                            data+="</tbody></table>";
                            jq('.reporttable').empty();
                            jq('.reporttable').html(data);
                            var table = jq('#followupTable').DataTable({
                                    dom: 'Bfrtip',
                                    select: true,
                                    buttons: [
                                    {
                                        text: 'Export',
                                        action: function ( e, dt, node, config ) {
                                        var rowdata= dt.row( { selected: true } ).indexes() ;
                                        var data = dt.cells( rowdata, 2 ).data();
                                        var id=dt.cells( rowdata, 0 ).data();
                                        if(data[0]==='FAILURE'){
                                            window.open("{{url()}}"+"/errorupload/"+id[0], '_blank');
                                        }else{
                                            $('.errmsg').html("<p class='uk-alert uk-alert-warning'>"+
                                                                "please select failed upload</p>");
                                        }
					console.log(data);
                                        },
                                        enabled: false
                                    }
                                    ]
                                    });
                                    
                                    table.on( 'select', function () {
                                        var selectedRows = table.rows( { selected: true } ).count();

                                    table.button( 0 ).enable( selectedRows === 1 );
                                   // table.button( 1 ).enable( selectedRows > 0 );
                                    } );
                        }else if(response.type==='errorreport'){
                            data="";
                            data+='<table class="uk-table" id="followupTable" >'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="uk-text-nowrap">Extract Type</th>'+
                                            '<th class="uk-text-nowrap">Total Records</th>'+
                                            '<th class="uk-text-nowrap">Error Records</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                            data+="<tr><td>objective List</td><td>"+response.data['object_list']['total']+"</td><td>"+response.data['object_list']['error']+"</td></tr>"+
                               "<tr><td>User Extract</td><td>"+response.data['user']['total']+"</td><td>"+response.data['user']['error']+"</td></tr>"+
                               "<tr><td>Objective Extract</td><td>"+response.data['object_progress']['total']+"</td><td>"+response.data['object_progress']['error']+"</td></tr>"+
                               "<tr><td>Badges Extract</td><td>"+response.data['badges']['total']+"</td><td>"+response.data['badges']['error']+"</td></tr>"+
                               "<tr><td>Leaderboard Extract</td><td>"+response.data['leaderboard']['total']+"</td><td>"+response.data['leaderboard']['error']+"</td></tr>";
                            data+="</tbody></table>";
                            jq('.reporttable').empty();
                            jq('.reporttable').html(data);
                            jq('#followupTable').DataTable();
                        }
                    }else{
                        
                    }
                }
            });
    
        });
    });
    
</script>

@stop


@section('content')
<div id="breadcrumb">
	<ul class="crumbs">
		<li class="first"><a href="{{url()}}/admindashboard/index" style="z-index:9;"><span></span>Home</a></li>
		<li ><a href="#" style="z-index:8;"><span></span>Reports</a></li>
		
	</ul>
</div>
<br clear="all"/>
<br clear="all"/>
<div class="md-card">
    <div class="md-card-content large-padding">
        <div class="row">
            
            <div class="uk-grid" data-uk-grid-margin >
                <div class="uk-width-medium-1-4">  
                    <div class="parsley-row form-group">
                        <label class=" md-input active" >Company</label>
                    <br><br>
                    <select class=" input-sm md-input" name="client" id="client" style="padding:0px; font-weight:bold;color: #727272;">
                            @foreach($client_data as $client)
                            <option value="{{$client->id}}">{{$client->client_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="uk-width-medium-1-4">  
                    <div class="parsley-row form-group">
                        <label class=" md-input active" >Report type</label>
                    <br><br>
                    <select class=" input-sm md-input" name="reporttype" id="reporttype" style="padding:0px; font-weight:bold;color: #727272;">
                            <option value="summaryreport">Data upload summary report</option>
                            <option value="errorreport">Data Error summary report</option>
                        </select>
                    </div>
                </div>
                <div class="uk-width-medium-1-4">
                    <div class="parsley-row" >
                        <label for="startdate" class=" md-input active">Start date<span
                            class="req">*</span></label><br><br>
                            <input type="text" id="startdate" class="uk-form-width-medium" required/>
                    </div>
                </div>
                <div class="uk-width-medium-1-4">
                    <div class="parsley-row" >
                        <label for="enddate" class=" md-input active">End date<span
                            class="req">*</span></label><br><br>
                            <input type="text" id="enddate" class="uk-form-width-medium" required/>
                    </div>
                </div>
              </div>
            </div>
        <br>
        <div class="row">
            
            <div class="uk-grid" data-uk-grid-margin >
                
                <div class="uk-width-medium-1-3">  
                    <div class="parsley-row form-group">
                        <button type="submit" id="generatereport" class="md-btn md-btn-primary" >Generate Report</button>
                    
                    </div>
                </div>
                <div class="uk-width-medium-1-3">  
                    <div class="parsley-row form-group">
                    
                    </div>
                </div>
                <div class="uk-width-medium-1-3">  
                    <div class="parsley-row form-group">
                    
                    </div>
                </div>
            </div>
        </div>
        
        <br>
        <div class="errmsg"></div>
        <div class="row reporttable">
             
        </div>
    </div>
</div>





@stop