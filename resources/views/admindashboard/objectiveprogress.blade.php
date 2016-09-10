@extends('layout.adminmaster')

@section('libraryCSS')

@stop

@section('libraryJS')

@stop


@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block text-center">
        <form  class="form-inline" action="{{url()}}/addobjectiveprogress" enctype="multipart/form-data" method="post">
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
        <th>Id</th>
        <th>Target points</th>
        <th>Till Now</th>
    </tr>
</thead>
<tbody>
    <?php for($i=0;$i<count($objective_progress_data);$i++){ ?>
        <tr><td>{{$objective_progress_data[$i]['id']}}</td><td>{{$objective_progress_data[$i]['total_target_pts']}}</td><td>{{$objective_progress_data[$i]['pts_tillnow']}}</td></tr>
    <?php } ?>
</tbody>
</table>
    




@stop