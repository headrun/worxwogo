(function($) {
  'use strict';
  $('.loader').removeAttr('hidden');
   var soapp={};
   var app={};
   
    // for google graphs
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart','bar']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      function drawChart() {
        if(app.obj_data){
          for(var i=0;i<app.obj_data.length;i++){
        
        if(app.obj_data[i].objective_type==='RANGE'){
          
          if(parseInt(app.obj_data[i].seg_obj_achvd_value) > 100 ){
          var extraper=  app.obj_data[i].seg_obj_achvd_value;
          }else{
          var extraper= '';
          }
          
          if((parseFloat(app.obj_data[i].seg_obj_achvd_value) <= 100) && (parseFloat(app.obj_data[i].seg_obj_achvd_value) >= 10) ){
            var percentdata=[0,parseFloat(app.obj_data[i].seg_obj_achvd_value)/100 ,];
          }else if(parseFloat(app.obj_data[i].seg_obj_achvd_value) < 10){
            var percentdata=[parseFloat(app.obj_data[i].seg_obj_achvd_value)/100 ,];
          }else if(parseFloat(app.obj_data[i].seg_obj_achvd_value) > 100){
            var percentdata=[0,1,];
          }
          
      
      
          
          // Create the data table.
         var data = google.visualization.arrayToDataTable([
          ['Genre','Bad ['+parseInt(app.obj_data[i].seg_bad_start_percentage) +'-'+parseInt(app.obj_data[i].seg_bad_end_percentage)+']%',
           'Good ['+parseInt(app.obj_data[i].seg_good_start_percentage)+'-'+parseInt(app.obj_data[i].seg_good_end_percentage)+']%',
           'Very Good ['+parseInt(app.obj_data[i].seg_vgood_start_percentage)+'-'+parseInt(app.obj_data[i].seg_vgood_end_percentage)+']%', {type: 'string', role: 'tooltip'},
           {type: 'string', role: 'annotation'},
          ],
          ['', parseFloat(app.obj_data[i].seg_bad_end_percentage),
          parseFloat(app.obj_data[i].seg_good_end_percentage)-parseFloat(app.obj_data[i].seg_bad_end_percentage),
          parseFloat(app.obj_data[i].seg_vgood_end_percentage)-parseFloat(app.obj_data[i].seg_good_end_percentage),
          '',extraper,
          ]
        ]);
        var options = {
          tooltip: {isHtml: false},
          isStacked: 'percent',
          height:90,
          chartArea: {width: '55%'},
          annotations: {
            alwaysOutside: true,
            textStyle: {
              fontSize: 10,
              auraColor: 'none',
              color: '#555',
           
            },
            boxStyle: {
              stroke: '#ccc',
              strokeWidth: 1,
              gradient: {
                color1: '#f3e5f5',
                color2: '#f3e5f5',
                x1: '0%', y1: '0%',
                x2: '100%', y2: '100%'
              }
            }
          },
        legend: {position: 'none', maxLines: 1},
        colors:['#d9534f','orange','lightgreen'],
        hAxis: {
          minValue: 0,
          ticks: percentdata
            
            }
        };
          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.BarChart(document.getElementById('chart'+app.obj_data[i].id));
          chart.draw(data, options);
        }
      }
    }
  }

   soapp.loadDataToUI=function(cardData){
    for(var i=0;i<cardData.length;i++){
    switch(cardData[i].objective_type){
      case "QUANTITY":
                      var qty = document.querySelector('.qty').cloneNode(true);
                      qty.classList.remove('qty');
                      qty.classList.add(cardData[i].id);
                      document.querySelector('.socards').appendChild(qty);
                     // $('.'+cardData[i].id).attr('onclick',"window.location.assign(apiurl+'/dashboard/leaderboard');");
                      $('.'+cardData[i].id).attr('title',cardData[i].obj_text);
                      $('.'+cardData[i].id).children('.card-block').children('.row').children('.qtytitle ').children('.card-title').html(cardData[i].obj_text);
                      if(cardData[i].qty_value_units=='Percentage'){ cardData[i].qty_value_units='%'; }
                      $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.milestonediv').children('.milestone').children('.highestachno').html(cardData[i].qty_highest_ach_no + '  ' + cardData[i].qty_value_units);
                      $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.milestonediv').children('.qtycurrentno').html(cardData[i].qty_current_ach_no + '  ' + cardData[i].qty_value_units);
                      $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-4').children('.objpoints').html(cardData[i].obj_points);
                      break;
      case "TARGET":
              var target = document.querySelector('.target').cloneNode(true);
              target.classList.remove('target');
              target.classList.add(cardData[i].id);
              document.querySelector('.socards').appendChild(target);
             // $('.'+cardData[i].id).attr('onclick',"window.location.assign(apiurl+'/dashboard/leaderboard');");
              $('.'+cardData[i].id).attr('title',cardData[i].obj_text);
              $('.'+cardData[i].id).children('.card-block').children('.row').first().children('.targettitle ').children('.card-title').html(cardData[i].obj_text);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-4').children('.objpoints').html(cardData[i].obj_points);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.progress').children('.progress-bar').attr('aria-valuenow',cardData[i].target_ach_percentage);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.progress').children('.progress-bar').attr('aria-valuemax',cardData[i].target_to_be_ach_percentage);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.progress').children('.progress-bar').css('width',+cardData[i].target_ach_percentage+'%');
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.progress').children('.progress-bar').css('background-color',cardData[i].target_obj_skew_indicator);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.progress').children('.progress-bar').children('.progress-text').html(cardData[i].target_ach_percentage+'%');
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.progress').children('.progress-text').html(cardData[i].target_to_be_ach_percentage+'%');
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.skewindicator').css('background-color',cardData[i].target_obj_skew_indicator);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.achvdvalue').html('Achieved: '+cardData[i].target_ach_value+'  '+cardData[i].target_value_units);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.targetvalue').html('Target: '+cardData[i].target_value+'  '+cardData[i].target_value_units);
              if((cardData[i].target_to_be_ach_val.length != 0) && (cardData[i].target_value_units.length != 0)){
                $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.tobeachvd').html('To be Achieved: '+cardData[i].target_to_be_ach_val+'  '+cardData[i].target_value_units);
              }else{
                $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.clearfix').hide();
                $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.boxdiv').hide();
                $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.tobeachvd').hide();
              }
              break;
      case "RANGE":
      
              var range= document.querySelector('.range').cloneNode(true);
              range.classList.remove('range');
              range.classList.add(cardData[i].id);
              document.querySelector('.socards').appendChild(range);
            //  $('.'+cardData[i].id).attr('onclick',"window.location.assign(apiurl+'/dashboard/leaderboard');");
              $('.'+cardData[i].id).attr('title',cardData[i].obj_text);
              $('.'+cardData[i].id).children('.card-block').children('.row').first().children('.col-lg-8').children('.card-title ').html(cardData[i].obj_text);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.chart ').attr('id','chart'+cardData[i].id);
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.bad').html('Bad  ['+ parseInt(cardData[i].seg_bad_start_percentage) +'-'+ parseInt(cardData[i].seg_bad_end_percentage) +']%  ');
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.good').html('Good  ['+ parseInt(cardData[i].seg_good_start_percentage) +'-'+ parseInt(cardData[i].seg_good_end_percentage) +']%  ');
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.vgood').html('Very Good  ['+ parseInt(cardData[i].seg_vgood_start_percentage) +'-'+ parseInt(cardData[i].seg_vgood_end_percentage) +']%  ');
              if((cardData[i].seg_obj_achvd_value.length != 0) && (cardData[i].seg_obj_achvd_value != 'NULL')&& (cardData[i].seg_obj_target_value.length != 0)&& (cardData[i].seg_obj_target_value != 'NULL')&& (cardData[i].seg_obj_target_value_units.length != 0)&& (cardData[i].seg_obj_target_value_units != 'NULL')&& (cardData[i].seg_obj_txt.length != 0)&& (cardData[i].seg_obj_txt != "NULL")){
                $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.newseg').html('[ ' + cardData[i].seg_obj_achvd_value+'%  of  ' + cardData[i].seg_obj_target_value + '  ' + cardData[i].seg_obj_target_value_units + '.  ' + cardData[i].seg_obj_txt + ' ]');
              }else{
                $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-8').children('.comment').children('.col-lg-12').children('.newseg').hide();
              }
              $('.'+cardData[i].id).children('.card-block').children('.row').last().children('.col-lg-4').children('.objpoints').html(cardData[i].obj_points);
              
              break;
      default:
              break;
      }
          $('.loader').delay(500).fadeOut('slow');
    }
    
   }

   soapp.getData=function(){
    $.ajax({
      type: "GET",
      url: apiurl+"/quick/getSoDataForSupervisor",
      data: {'so_id': so_id },
      dataType: 'json',
      success: function(response){
        if(response.status=='success'){

          //loading data to local storage
          localStorage.supSoData=JSON.stringify(response.data);
          app.obj_data=response.data;
          soapp.loadDataToUI(response.data);     
        }
        console.log(response);
      }
    });
    
   }
   
   soapp.getData();
	
  $('.footerleaderboardbutton').addClass('active');

  $(window).resize(function(){
        drawChart();
       
  });


}(jQuery));