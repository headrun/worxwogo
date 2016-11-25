(function($) {
  'use strict';

  var leadapp={
    showing_MTD_Data:true,
    showing_YTD_Data:false,
    graph_data:false,

  };
  var objective_data={};

  $('.loader').removeAttr('hidden');

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var graph_data;
    
    if(leadapp.graph_data){
      for(var i=0;i<leadapp.data.length;i++){
        // Create the data table.
        
        for(var j=0;j<leadapp.data[i]['monthwise_data'].length;j++){
          if(j==0){
            graph_data=[];
            graph_data[0]=['Month','Points'];
            graph_data[j+1]=[parseInt(leadapp.data[i]['monthwise_data'][j]['month_no']),parseInt(leadapp.data[i]['monthwise_data'][j]['points'])]
            
          }
          if(j!=0){
          graph_data[j+1]=[leadapp.data[i]['monthwise_data'][j]['month_no'],leadapp.data[i]['monthwise_data'][j]['points']]
          }
        }
        //console.log(graph_data);
        
      /*   var data = google.visualization.arrayToDataTable([
          [X', 'Y'],
              [1, 3],
              [2, 2.5],
              [3, 3],
              [4, 4],
              [5, 4],
              [6, 3],
              [7, 2.5],
              [8, 3]
          ]);
          */
         var data=google.visualization.arrayToDataTable(graph_data);
         var options = {
          legend: 'none',
          hAxis: { 
                   gridlines: {
                     color: 'transparent'
                   },
                   textPosition: 'none'
                 },
          colors: ['#00BBD3'],
          pointSize: 4,
          pointShape: 'circle',
          vAxis: {
            textPosition: 'none',
            gridlines: {
              count:0,
              color: 'transparent'
            },
            baselineColor: 'white' 
          },
          annotations: { stemColor: 'white', textStyle: { fontSize: 16 } },
        };

       var chart = new google.visualization.LineChart(document.getElementById('chart'+leadapp.data[i]['emp_id']));
          chart.draw(data, options);
      }
    }
  }
  leadapp.loadDataToUI=function(data){
    if(leadapp.showing_YTD_Data){
      for(var i=0;i<data.length;i++){
        console.log(data);
        console.log('YTD');

        var leaderboardcard = document.querySelector('.leaderboard-block').cloneNode(true);
        leaderboardcard.classList.add('emp_id_'+data[i]['emp_id']);
        document.querySelector('.card-block').appendChild(leaderboardcard);
        //$('.emp_id_'+data[i]['emp_id']).removeClass('leaderboard-block');
        $('.emp_id_'+data[i]['emp_id']).attr('emp_id',data[i]['emp_id']);
        $('.emp_id_'+data[i]['emp_id']).children('.row').first().children('.col-lg-2').children('.leaderboard-rank').html(i+1);
        $('.emp_id_'+data[i]['emp_id']).children('.row').first().children('.col-lg-6').children('.username').html(data[i]['emp_name']);
        $('.emp_id_'+data[i]['emp_id']).children('.row').first().children('.col-lg-4').last().children('.leaderboardpoints').html(data[i]['emp_points']+" pts");
        $('.emp_id_'+data[i]['emp_id']).children('.row').last().children('.col-lg-8').last().children('.row').last().children('.call').attr('href',"tel:"+data[i]['emp_mobile_number']);
        $('.emp_id_'+data[i]['emp_id']).children('.row').last().children('.col-lg-8').children('.leaderboardchart').attr('id','chart'+data[i]['emp_id']);
        //$('.emp_id_'+data[i]['emp_id']).children('.row').last().children('.col-lg-8').append("<div class='icons'>Buttons Here</div><hr>");
        
      }
      leadapp.graph_data=true;
      drawChart();
    }else if(leadapp.showing_MTD_Data){
        
      console.log('MTD');
      for(var i=0;i<data.length;i++){
        var leaderboardcard = document.querySelector('.leaderboard-block').cloneNode(true);
        leaderboardcard.classList.add('emp_id_'+data[i]['emp_id']);
        document.querySelector('.card-block').appendChild(leaderboardcard);
        //$('.emp_id_'+data[i]['emp_id']).removeClass('leaderboard-block');
        $('.emp_id_'+data[i]['emp_id']).attr('emp_id',data[i]['emp_id']);
        $('.emp_id_'+data[i]['emp_id']).children('.row').first().children('.col-lg-2').children('.leaderboard-rank').html(i+1);
        $('.emp_id_'+data[i]['emp_id']).children('.row').first().children('.col-lg-6').children('.username').html(data[i]['emp_name']);
        $('.emp_id_'+data[i]['emp_id']).children('.row').first().children('.col-lg-4').last().children('.leaderboardpoints').html(data[i]['emp_points']+" pts");
        $('.emp_id_'+data[i]['emp_id']).children('.row').last().children('.col-lg-8').children('.leaderboardchart').hide();
        $('.emp_id_'+data[i]['emp_id']).children('.row').last().children('.col-lg-8').last().children('.row').last().children('.call').attr('href',"tel:"+data[i]['emp_mobile_number']);
        
        leadapp.graph_data=false;
      }

    }

    $('.loader').delay(500).fadeOut('slow');

  }



  leadapp.getData=function(){
    var send_data_type;

    if(leadapp.showing_YTD_Data){
      send_data_type='YTD';
    }
    if(leadapp.showing_MTD_Data){
      send_data_type='MTD';
    }
      
    $.ajax({
      type: "GET",
      url: apiurl+"/quick/getSupervisorLeaderboardData",
      data: {'obj_id':obj_id,'send_data_type':send_data_type},
      dataType: 'json',
      success: function(response){
        console.log(response);
        if(response.status=='success'){


          leadapp.data=response.data;
          
          /*
          if(send_data_type=='MTD'){
            
            if(!localStorage.objective_data){
              var objective_data=[{'obj_id':obj_id,'data':response.data}];
              localStorage.objective_data=JSON.stringify(objective_data);
  
            }else{
               var found=false;
               var temp=JSON.parse(localStorage.objective_data);
               for(var i=0;i<temp.length;i++){
                  if(temp[i]['obj_id']==obj_id){
                    found=true;
                    temp[i]['data']=response.data;
                  }
               }
               if(found){
                localStorage.objective_data=JSON.stringify(temp);
               }else{
                 var temp_data=JSON.parse(localStorage.objective_data);
                 temp_data[temp_data.length]=[{'obj_id':obj_id,'data':response.data}];
                 localStorage.objective_data=JSON.stringify(temp_data);
                 
               }             
               
            }
                       
                      
                        
          }else if(send_data_type=='YTD'){
          
            var data= {'obj_id':obj_id,'YTD_data':response.data};
            localStorage.YTD_data=JSON.stringify(response.data);
          
          }
          */
            leadapp.loadDataToUI(response.data); 
          }
           

        }
        
      
    });

  }

  leadapp.getData();

  	$('.footerleaderboardbutton').addClass('active');

  	/*events*/
  

    $('.ytd-btn').click(function(){
      $('.loader').show();
      $('.card-block').empty();
      $('.mtd-btn').removeClass('active');
      $('.ytd-btn').addClass('active');
      leadapp.showing_MTD_Data=false;
      leadapp.showing_YTD_Data=true;
      leadapp.getData();
    });

    $('.mtd-btn').click(function(){
      $('.loader').show();
      $('.card-block').empty();
      $('.ytd-btn').removeClass('active');
      $('.mtd-btn').addClass('active');
      leadapp.showing_MTD_Data=true;
      leadapp.showing_YTD_Data=false;
      leadapp.getData();
    });

     $(window).resize(function(){
        drawChart();
       
      });


     //events
  $( ".card-block" ).on( "click",".leaderboard-block", function( event ) {
    event.preventDefault();
    $('.loader').show();
    window.location.assign(apiurl+"/dashboard/supleaderboardso/"+$(this).attr('emp_id'));
    console.log('working');
  });


  $('.card-block').on('click','.leaderboardmsg',function(event){
    event.stopPropagation();
    $('.loader').show();
    window.location.assign(apiurl+'/dashboard/sendmsg');
  });
  $('.card-block').on('click','.leaderboardlike',function(event){
    event.stopPropagation();
    $('.loader').show();
    window.location.assign(apiurl+"/dashboard/sendlike");
  });
  $('.card-block').on('click','.call',function(event){
    event.stopPropagation();
   
  });


  

}(jQuery));