@extends('layout.supervisormaster')

@section('libraryCSS')
<style>
#exTab3 .nav-pills > li > a {
    border-radius: 10px 10px 0 0;
}
#exTab3 .tab-content {
         color: black;
         background-color: #fff;
         padding: 5px 15px;
         border-radius: 5px;
         box-shadow: 6px 6px 3px #888888;
}
.table-condensed {
     border-radius: 5px;
     color:black;
     
 }
 .tableheading {
     background-color: #6F6F6F;
     color: white;
 }
 .color-lightgrey {
     background-color: lightgrey;
 }
 .color-white {
     color: white;
 }


</style>
@stop
@section('libraryJS') 

@stop
@section('mainBody')

<br>
<br>
<div id="exTab3" class="container">	
                <ul  class="nav nav-pills">
                    <li class="active profilebackcolor">
                    	<a class="link" href="#3b" data-toggle="tab"><h5>Profile</h5>
                    	</a>
                    </li>
                </ul>

		<div class="tab-content clearfix">
                    
                    <div class="tab-pane active " id="3b">
                        <table class="table-condensed table-responsive profiletable" width="100%">
                            <thead>
                                <tr class="tableheading color-white">
                                    <th>sr</th>
                                    <th>Particular</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td>1</td>
                                    <td>Name</td>
                                    <td class="username">{{$user_data['name']}}</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>2</td>
                                    <td>Employee Id</td>
                                    <td class="emp_code">{{$user_data['emp_code']}}</td>
                                </tr>
                                <tr >
                                    <td>3</td>
                                    <td>Contact No</td>
                                    <td class="mob_no">{{$user_data['mobilenumber']}}</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>4</td>
                                    <td>E-mail</td>
                                    <td class="e-mail">{{$user_data['email']}}</td>
                                </tr>
                                <tr >
                                    <td>5</td>
                                    <td>Designation</td>
                                    <td class="designation">{{$user_data['designation']}}</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>6</td>
                                    <td>Company Name</td>
                                    <td class="cmp_name">{{$user_data['client_name']}}</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Territory</td>
                                    <td class="territory">{{$user_data['territory']}}</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>8</td>
                                    <td>Region</td>
                                    <td class="region">{{$user_data['region']}}</td>
                                </tr>
                            </tbody>
                        </table> 
                          
                            
                    </div>
                </div>
            </div>
@stop

@section('pageHeading')

Profile Info

@stop

@section('navbarName')
@stop


@section('extra')

@stop