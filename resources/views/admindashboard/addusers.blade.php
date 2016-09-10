@extends('layout.adminmaster')

@section('libraryCSS')

@stop

@section('libraryJS')

@stop


@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block text-center">
        <form  class="form-inline" action="{{url()}}/addusers" enctype="multipart/form-data" method="post">
            {!! csrf_field() !!}
            <input type="file" name="user" class="form-control" required>
            <input type="submit" value="upload" class="btn btn-success form-control">
        </form>
    </div>
</div>
</br>
    
    
<table  class="table table-striped" style="background-color:#fff; border-radius:5px; ">
<thead>
    <tr>
        <th>Name</th>
        <th>Mobile Number</th>
    </tr>
</thead>
<tbody>
    <?php for($i=0;$i<count($users_data);$i++){ ?>
        <tr><td>{{$users_data[$i]['name']}}</td><td>{{$users_data[$i]['mobilenumber']}}</td></tr>
    <?php } ?>
</tbody>
</table>
    




@stop