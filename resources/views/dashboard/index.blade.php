@extends('layout.master')

@section('libraryCSS')
<style>
    /*blue  00BBD3 */
    /*cream F0F0F0 */
    
    .circle{
        width: 100px;
	height: 150px;
        
        -moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
    }
    
    
    .card{
        background-color: #fff;
        margin:20px;
        border-radius: 5px;
        box-shadow: 6px 6px 3px #888888;
        cursor: pointer;
    }
    
    .card-block{
        padding:10px;
    }
    .card-title{
        font-weight: bold;
        color:black;
    }
    
    tspan{
        font-size:10px;
    }

    /* for progressive bar*/
    .container {
        width: 100%;
    }
    
    .milestone{
        cursor:pointer;
    }

.item {
    width: 7%;
    box-shadow:inset 0 1px 2px rgba(0,0,0,.1);
    background-color: #f5f5f5;
    border-radius: 3px;
    margin-right: 2px;
    float: left;
    display: block;
    height: 20px;
}

.filled {
    background-color: #337ab7 !important;
}

.qtyem{
    font-size:80%;
    font-weight:lighter;
}

.chart {
  width: 100%; 
  height: 100px;
}
    
</style>
@stop


@section('libraryJS')

<!--Load the AJAX API-->
<script type="text/javascript" src="{{url()}}/assets/js/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart','bar']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
          @foreach ($objective_data as $objective) 
          <?php if($objective->objective_type==='RANGE'){ ?>

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
        ['Genre','bad','good','vgood', { role: 'annotation' } ],
        ['', {{$objective->seg_bad_end_percentage}}, 
            <?php echo $objective->seg_good_end_percentage-$objective->seg_bad_end_percentage;?>, 
            <?php echo $objective->seg_vgood_end_percentage-$objective->seg_good_end_percentage;?>,
            '']
        ]);

        // Set chart options
        
        var options = {
          isStacked: 'percent',
          height:90,
          legend: {position: 'top', maxLines: 1},
          colors:['#d9534f','orange','lightgreen'],
          hAxis: {
            minValue: 0,
            <?php if(($objective->seg_obj_achvd_value >= $objective->seg_good_end_percentage) && ($objective->seg_obj_achvd_value <= $objective->seg_vgood_end_percentage)){ ?>
            
            ticks: [0,{{$objective->seg_bad_end_percentage/100}},{{$objective->seg_good_end_percentage/100}},{{$objective->seg_obj_achvd_value/100}},{{$objective->seg_vgood_end_percentage/100}}, 1]
            
            <?php }else if(($objective->seg_obj_achvd_value >= $objective->seg_bad_end_percentage) && ($objective->seg_obj_achvd_value <= $objective->seg_good_end_percentage)){?>
            ticks: [0,{{$objective->seg_bad_end_percentage/100}},{{$objective->seg_obj_achvd_value/100}},{{$objective->seg_good_end_percentage/100}},{{$objective->seg_vgood_end_percentage/100}}, 1]
            <?php }else{ ?>
            ticks: [0,{{$objective->seg_obj_achvd_value/100}},{{$objective->seg_bad_end_percentage/100}},{{$objective->seg_good_end_percentage/100}},{{$objective->seg_vgood_end_percentage/100}}, 1]
            <?php } ?>
          }
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById("{{'chart'.$objective->id}}"));
        chart.draw(data, options);
         <?php }?>
//       <?php //}else if($objective->objective_type==='TARGET'){?>
//        var datatarget = google.visualization.arrayToDataTable([
//        ['', 'Achieved value in {{$objective->target_value_units}}', 'Target value in {{$objective->target_value_units}}'],
//        ['', {{$objective->target_ach_value}},{{$objective->target_value}}],
//       
//      ]);
//
//      var optionstarget = {
//        //chartArea: {width: '65%'},
//        legend: {position: 'top', maxLines: 1},
//        isStacked: true,
//        colors: ['#d9534f','lightgreen'],
//        hAxis: {
//         
//          minValue: 0,
//          maxValue: {{$objective->target_ach_value}},
//        },
//        
//      };
//        var chart = new google.visualization.BarChart(document.getElementById("{{'chart'.$objective->id}}"));
//        chart.draw(datatarget, optionstarget);
//       <?php// } ?>
      
      
        @endforeach
      }
      
      
      
      
      $(window).resize(function(){
        drawChart();
       
        });
    </script>
    
    
<script>
    $('.card').click(function(){
        window.location.assign('{{url()}}/dashboard/leaderboard');
    });

</script>


@stop

@section('pageheading')
My Objectives
@stop


@section('content')

@foreach ($objective_data as $objective) 

    <?php if($objective->objective_type==='QUANTITY'){ ?>
<!--Card-->
        <div class="card">
            <!--Card content-->
            <div class="card-block">
             <!--Title-->
             <div class="row">
                 <div class="col-lg-8  col-md-8  col-sm-8 col-xs-9">
                    <h4 class="card-title">{{$objective->obj_text}}</h4>
                 </div>
                 <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
                     <h5 class="card-title text-right">Earned points</h5>
                 </div>
             </div>
                <!--Text-->
                <div class="row">
                    <div class="col-lg-8  col-md-8  col-sm-8 col-xs-9">
                        <label class="text-center milestone" style=" font-size:12px;  margin-left: 15px; border:solid 2px; border-radius:30%; padding:10px;color:#00BBD3;">MILESTONE <br> {{$objective->qty_current_ach_no}}&nbsp;<?php if($objective->qty_value_units=='Percentage'){echo '%';}else{echo $objective->qty_value_units;} ?></label>
                        {{$objective->qty_highest_ach_no}}&nbsp;<?php if($objective->qty_value_units=='Percentage'){echo '%';}else{echo $objective->qty_value_units;} ?>
                        <br>
                    </div>
                    <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
                        <h2 class="text-right" style="margin-top:15px;">{{$objective->obj_points}}</h2>
                    </div>
                </div>
       
            </div>
            <!--/.Card content-->

        </div>
<!--/.Card-->

<?php }elseif($objective->objective_type==='TARGET'){?>

<!--Card-->

<div class="card" >
    <!--Card content-->
    <div class="card-block">
        <!--Title-->
       <div class="row">
                 <div class="col-lg-8  col-md-8  col-sm-8 col-xs-9">
                    <h4 class="card-title">{{$objective->obj_text}}</h4>
                 </div>
                 <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
                     <h5 class="card-title text-right">Earned points</h5>
                 </div>
       </div>
        <!--Text-->
        <div class="row">
            <div class="col-lg-8  col-md-8  col-sm-8 col-xs-9">
<!--                <div id="{{'chart'.$objective->id}}" class="chart" style="margin-left:-10px"></div>-->
                
                <div class=" progress " >
                    <div class="progress-bar progress-bar-striped active " role="progressbar" aria-valuenow="{{$objective->target_ach_percentage}}"
                        aria-valuemin="0" aria-valuemax="100" style="width:{{$objective->target_ach_percentage}}%;background-color:{{$objective->target_obj_skew_indicator}};">
                        <label class="progress-text">{{$objective->target_ach_percentage}}% </label>
                    </div>
                </div>
                <div class="row comment" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div style="height:15px;width:15px;padding:5px;display:inline-block;background-color:{{$objective->target_obj_skew_indicator}};"></div>
                    <label style="font-weight:normal;display:inline-block;font-size:smaller; ">Achieved target [{{$objective->target_ach_value}}&nbsp;{{$objective->target_value_units}} ]</label>&nbsp;
                    
                    <div style="height:15px;width:15px;padding:5px;display:inline-block;background-color:#f5f5f5"></div>
                    <label style="font-weight:normal;display:inline-block;font-size:smaller;">Target [{{$objective->target_to_be_ach_val}}&nbsp;{{$objective->target_value_units}} ]</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
             <h2 class="text-right" style="margin-top:15px;">{{$objective->obj_points}}</h2>
            </div>
        </div>
    </div>
    <!--/.Card content-->

</div>
<!--/.Card-->

<?php }elseif($objective->objective_type==='RANGE'){ ?>

<!--Card-->
<div class="card">
    <!--Card content-->
    <div class="card-block">
        <!--Title-->
       <div class="row">
                 <div class="col-lg-8  col-md-8  col-sm-8 col-xs-9">
                    <h4 class="card-title">{{$objective->obj_text}}</h4>
                 </div>
                 <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
                     <h5 class="card-title text-right">Earned points</h5>
                 </div>
       </div>
        <!--Text-->
        
        <div class="row">
            <div class="col-lg-8  col-md-8  col-sm-8 col-xs-9">
                  
                <div id="{{'chart'.$objective->id}}" class="chart" style="margin-left:-10px"></div>
                
            </div>
            <div class="col-lg-4  col-md-4  col-sm-4 col-xs-3">
             <h2 class="text-right" style="margin-top:15px;">{{$objective->obj_points}}</h2>
            </div>
        </div>
        
    </div>
    <!--/.Card content-->

</div>
<!--/.Card-->

<?php } ?>
@endforeach




@stop

