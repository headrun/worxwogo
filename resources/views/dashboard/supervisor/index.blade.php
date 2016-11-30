@extends('layout.supervisormaster')

@section('libraryCSS')
<style>

.progress-bar{
  background-color: #00BBD3;
  -webkit-transition: width 1.5s ease-in-out;
  transition: width 1.5s ease-in-out;
}


.progress{
  border-radius:0;
  overflow:visible;
  margin-top:25px;
}
.percentagefields{
  position: relative;
  color: black;
  margin-top:10px;
}
.tooltip.top{
  margin-top:5px;
}
.pbar{
  border-right:1px solid white ;

}
.pstart{
  border-top-left-radius:5px;
  border-bottom-left-radius:5px;
} 
.pend{
  border-top-right-radius:5px;
  border-bottom-right-radius:5px;
}
.pointsbox{
  background-color:lightgoldenrodyellow;
  border:solid 2px goldenrod;
  border-radius:5px;
  color:goldenrod;
  /*margin-top:-15px;
  padding: 5px;*/

}

.card-widget{
  margin-bottom:20px;
  margin-top:20px;
}

.tooltip{
  z-index:1000;
}
.removedpercentagefields{
  position: relative;
  color: black;
  margin-top:25px;
} 
}
</style>

@stop
@section('libraryJS') 

<script src="{{url()}}/assets/js/supervisorapp.js" async ></script>
<script>
$('.footerdashboard').addClass('active');
$('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
</script>

@stop


@section('mainBody')

@stop

@section('pageHeading')

My Team Progress

@stop



@section('extra')

<card hidden>
    <!--Card-->
    <div class="card cardcopy" title="">
      <!--Card content-->
      <div class="card-block">
        <!--Title-->
        <div class="row">
          <div class="col-lg-8  col-md-8  col-sm-8 col-xs-8">
            <h4 class="card-title">MSP</h4>
          </div>
          <div class="col-lg-4  col-md-4  col-sm-4 col-xs-4 ">
            <div class="pointsbox center-block">
              <h4 class="text-center points" >
                <span class="pointsno">0</span>
                <br> 
                Points
              </h4>
            </div>
          </div>
        </div>
        <!--Text-->
        <div class="row card-widget">
          <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12 ">

            <div class="progress">
              <div class="progress-bar progress-bar-success pbar pstart pbar1" role="progressbar" style="width:25%">
                <span  class="popOver" data-toggle="tooltip" data-placement="top" title="4"></span>
                <h6 class="percentagefields"><span class="pull-left">0%</span><span class="pull-right chartmiddlefield">25%</span></h6>
              </div>
              <div class="progress-bar progress-bar-success pbar pbar2" role="progressbar" style="width:25%">
                <span  class="popOver" data-toggle="tooltip" data-placement="top" title="3"></span>
                <h6 class="percentagefields "><span class="pull-right chartmiddlefield">50%</span></h6>
              </div>
              <div class="progress-bar progress-bar-success pbar pbar3" role="progressbar" style="width:25%">
                <span  class="popOver" data-toggle="tooltip" data-placement="top" title="2"></span>
                <h6 class="percentagefields"><span class="pull-right chartmiddlefield">75%</span></h6>
              </div>
              <div class="progress-bar progress-bar-success pbar pend pbar4" role="progressbar" style="width:25%">
                <span  class="popOver" data-toggle="tooltip" data-placement="top" title="1"></span>
                <h6 class="percentagefields"><span class="pull-right chartmiddlefield">100%</span></h6>
              </div>
            </div>
        
          
          </div>
          
        </div>
        
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->
  </card>


@stop



