
(function($) {
  'use strict';

  var app={};

  $('.loader').removeAttr('hidden');



  app.loadDataToUI=function(data){
    $('.cards').empty();
    for(var i=0;i<data.length;i++){
      if(data[i]['objective_type']=='RANGE'){
        console.log('RANGE');
        var card = document.querySelector('.cardcopy').cloneNode(true);
        card.classList.add('objective'+data[i]['obj_id']);
        card.classList.remove('cardcopy');
        
        document.querySelector('.cards').appendChild(card);
        $('.objective'+data[i]['obj_id']).attr('title',data[i]['objective_name']);
        $('.objective'+data[i]['obj_id']).attr('obj_id',data[i]['obj_id']);

        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').first().children('.col-lg-8').children('.card-title').html(data[i]['objective_name']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').first().children('.col-lg-4').children('.pointsbox').children('.points').html(data[i]['obj_points']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar4').remove();
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').addClass('pend');

        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.percentagefields').children('.pull-left').html(parseInt(data[i]['seg_bad_start_percentage'])+'%');
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.percentagefields').children('.pull-right').html(parseInt(data[i]['seg_bad_end_percentage'])+'%');
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.percentagefields').children('.pull-right').html(parseInt(data[i]['seg_good_end_percentage'])+'%');
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.percentagefields').children('.pull-right').html(parseInt(data[i]['seg_vgood_end_percentage'])+'%');
        
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').css('width',parseInt(data[i]['seg_bad_end_percentage'])+'%');
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').css('width',(parseInt(data[i]['seg_good_end_percentage'])-parseInt(data[i]['seg_bad_end_percentage']))+'%');
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').css('width',(100-parseInt(data[i]['seg_good_end_percentage']))+'%');  
        
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').children('.tooltip-inner').html("<i class='fa fa-user' aria-hidden='true'></i> "+data[i]['seg_bad_percentage']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').children('.tooltip-inner').html("<i class='fa fa-user' aria-hidden='true'></i> "+data[i]['seg_good_percentage']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').children('.tooltip-inner').html("<i class='fa fa-user' aria-hidden='true'></i> "+data[i]['seg_vgood_percentage']);
        
        // for colors red,orange,green
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').css('background-color','#d9534f');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').css('background-color','orange');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').css('background-color','lightgreen');  
        //arrow and tooltipinner
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').children('.tooltip-arrow').css('border-top-color','#d9534f');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').children('.tooltip-inner').css('background-color','#d9534f');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').children('.tooltip-arrow').css('border-top-color','orange');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').children('.tooltip-inner').css('background-color','orange');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').children('.tooltip-arrow').css('border-top-color','lightgreen');  
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').children('.tooltip-inner').css('background-color','lightgreen');  
                                


        if(data[i]['seg_bad_percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.percentagefields').removeClass('percentagefields');
        }
        if(data[i]['seg_good_percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.percentagefields').removeClass('percentagefields');
        }
        if(data[i]['seg_vgood_percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.percentagefields').removeClass('percentagefields');
        }

      }else{

        var card = document.querySelector('.cardcopy').cloneNode(true);
        card.classList.add('objective'+data[i]['obj_id']);
        card.classList.remove('cardcopy');
        document.querySelector('.cards').appendChild(card);
        $('.objective'+data[i]['obj_id']).attr('title',data[i]['objective_name']);
        $('.objective'+data[i]['obj_id']).attr('obj_id',data[i]['obj_id']);
      
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').first().children('.col-lg-8').children('.card-title').html(data[i]['objective_name']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').first().children('.col-lg-4').children('.pointsbox').children('.points').html(data[i]['obj_points']);

        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').children('.tooltip-inner').html(data[i]['percent']['0to25percentage']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').children('.tooltip-inner').prepend("<i class='fa fa-user' aria-hidden='true'></i> "); 
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').children('.tooltip-inner').html(data[i]['percent']['26to50percentage']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').children('.tooltip-inner').prepend("<i class='fa fa-user' aria-hidden='true'></i> "); 
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').children('.tooltip-inner').html(data[i]['percent']['51to75percentage']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').children('.tooltip-inner').prepend("<i class='fa fa-user' aria-hidden='true'></i> "); 
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar4').children('.tooltip').children('.tooltip-inner').html(data[i]['percent']['76to100percentage']);
        $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar4').children('.tooltip').children('.tooltip-inner').prepend("<i class='fa fa-user' aria-hidden='true'></i> "); 
      
        if(data[i]['percent']['0to25percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar1').children('.percentagefields').removeClass('percentagefields');
        }
        if(data[i]['percent']['26to50percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar2').children('.percentagefields').removeClass('percentagefields');
      
        }
        if(data[i]['percent']['51to75percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar3').children('.percentagefields').removeClass('percentagefields');
      
        }
        if(data[i]['percent']['76to100percentage']===0){
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar4').children('.tooltip').hide();  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar4').children('.percentagefields').addClass('removedpercentagefields');  
          $('.objective'+data[i]['obj_id']).children('.card-block').children('.row').last().children('.col-lg-12').children('.progress').children('.pbar4').children('.percentagefields').removeClass('percentagefields');
      
        }

      }     
    }
    $('.loader').delay(500).fadeOut('slow');

  }

  app.getdata=function(){

    $.ajax({
      type: "GET",
      url: apiurl+"/quick/getSupervisorDashboardData",
      data: {},
      dataType: 'json',
      success: function(response){
        
        if(response.status=='success'){
          console.log(response);
          //loading data to local storage
          localStorage.supDashboardData=JSON.stringify(response.data);
          app.loadDataToUI(response.data);     
        }
        
      }
    });

  }

 // if(!localStorage.supDashboardData){
    //loading data for first time.
    console.log('first time');
    app.getdata();  
  /*}else{
    //Already we have old data in localstorage.
    app.supdashboard_data=JSON.parse(localStorage.supDashboardData);
    app.loadDataToUI(app.supdashboard_data);
    app.getdata();
    console.log('showing old data and trying to load new data ');
  }
  */
  


  //events

  $( ".cards" ).on( "click",".card", function( event ) {
    event.preventDefault();
    $('.loader').show();
    window.location.assign(apiurl+"/dashboard/supervisorleaderboard/"+$(this).attr('obj_id'));
    console.log('working');
  });

}(jQuery));
