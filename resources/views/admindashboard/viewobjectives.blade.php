@extends('layout.adminmaster')


@section('libraryCSS')
<style> 
    
</style>

@stop


@section('libraryJS')
<!-- datatables -->
    <script src="{{url()}}/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables colVis-->
    <script src="{{url()}}/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
    <!-- datatables tableTools-->
    <script src="{{url()}}/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
    <!-- datatables custom integration -->
    <script src="{{url()}}/assets/js/custom/datatables_uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="{{url()}}/assets/js/pages/plugins_datatables.min.js"></script>
    
    
<script>
var data='';
$(document).ready(function(){
    
    
    
    
 $.ajax({
    type: "POST",
    url: "{{URL::to('/quick/getobjlist')}}",
    data: {'company_id':$('#client').val()},
    dataType: 'json',
    success: function(response){
            console.log(response);
            if(response.status==='success'){
               data='';
               data+='<table class="uk-table dashboardTable" id="followupTable" >'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="uk-text-nowrap">Objective</th>'+
                                            '<th class="uk-text-nowrap">Status</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="objlist">';
                
               for(var i=0;i<response.objectivelist.length;i++){
                   data+="<tr><td>"+response.objectivelist[i]['objective_name']+"</td><td>"+response.objectivelist[i]['status']+
                        "</td></tr>";
               }
               data+='</tbody>'+
                                '</table>';
               
               $('.viewtable').html(data);
               $("#followupTable").DataTable({
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {

            // Bind click event
            $(nRow).click(function() {
                  //window.open($(this).find('a').attr('href'));
			//	window.location = $(this).find('a').attr('href');
                  //OR

                // window.open(aData.url);

            });

            return nRow;
        },
        "iDisplayLength": 10,
        "lengthMenu": [ 10, 50, 100, 150, 200 ]
    });
            }else{
               
            }
    }
 });
 
 $('#client').change(function(){
    $.ajax({
    type: "POST",
    url: "{{URL::to('/quick/getobjlist')}}",
    data: {'company_id':$('#client').val()},
    dataType: 'json',
    success: function(response){
            console.log(response);
            if(response.status==='success'){
               data='';
                data+='<table class="uk-table dashboardTable" id="followupTable" >'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th class="uk-text-nowrap">Objective</th>'+
                                            '<th class="uk-text-nowrap">Status</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id="objlist">';
                                    	                                   
                                    
               for(var i=0;i<response.objectivelist.length;i++){
                   data+="<tr class='uk-table-middle smallText'><td class='uk-width-3-10 uk-text-nowrap'>"+response.objectivelist[i]['objective_name']+"</td><td class='uk-width-3-10 uk-text-nowrap'>"+response.objectivelist[i]['status']+
                        "</td></tr>";
               }
               data+='</tbody>'+
                                '</table>';
               $('.viewtable').empty();
               console.log(data);
               $('.viewtable').html(data);
               $("#followupTable").DataTable();
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
		<li ><a href="#" style="z-index:8;"><span></span>View Objectives</a></li>
		
	</ul>
</div>
<br clear="all"/>
<br clear="all"/>


<div class="md-card">
    <div class="md-card-content large-padding">
        <div class="row">
            
            <div class="uk-grid" data-uk-grid-margin >
                <div class="uk-width-medium-1-3">  
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
                <div class="uk-width-medium-1-3">  
                    <div class="parsley-row form-group">
                    </div>
                </div>
                <div class="uk-width-medium-1-3">  
                    <div class="parsley-row form-group md-input-filled">
                    
                    </div>
                </div>
            </div>
        </div>
        <br>
         <div class="uk-width-medium-1-1 viewtable">
                    
                            	<table class="uk-table dashboardTable" id="followupTable" >
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Objective</th>
                                            <th class="uk-text-nowrap">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="objlist">
                                    	                                   
                                    </tbody>
                                </table>
                                
                        
        </div>
<!--        <br>
        <div class="row">
            <table  class="table table-striped" style="background-color:#fff; border-radius:5px; ">
                <thead>
                    <tr>
                    <th>Objective</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody id="objlist">
                    
                </tbody>
            </table>
            
        </div>
    </div>
</div>-->
@stop