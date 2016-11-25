
(function($) {
  'use strict';
 /*
  var db = new Dexie("xg_db");
	db.version(1).stores({
		client_data: 'client_logo_ext, client_name, created_at, deleted_at, id, status, program_name, updated_at',
		client_last_updated: 'client_last_updated',
		obj_data: 'client_id,client_name,created_at,created_by,created_ts,deleted_at,emp_code,id,'+
				  'mobile_no,obj_list_id,obj_no,obj_points,obj_text,objective_datatype,objective_type,qty_current_ach_no,'+
				  'qty_highest_ach_no,qty_value_units,seg_bad_end_percentage,seg_bad_start_percentage,seg_end_percentage,'+
				  'seg_end_value,seg_good_end_percentage,seg_good_start_percentage,seg_obj_achvd_value,seg_obj_target_value'+
				  'seg_obj_target_value_units,seg_obj_txt,seg_start_percentage,seg_start_value,seg_value_units,'+
				  'seg_vgood_end_percentage,seg_vgood_start_percentage,status,target_ach_percentage,target_ach_value,target_obj_mnth'+
				  'target_obj_skew_indicator,target_obj_skew_target,target_to_be_ach_percentage,target_to_be_ach_val,target_value,'+
				  'target_value_units,updated_at,updated_by,upload_id,user_id,user_name',
	    user_data: 'client_id, client_name, created_at, created_by, created_ts, deleted_at, designation, email, emp_code, id,'+
            	   'location_name, mobilenumber, name, region, reporting_designation, reporting_name, reporting_user, status,'+
				   'territory, updated_at, updated_by, upload_id, user_level_img_path, user_level_name, user_photo_path,'+
				   'user_points, user_type',
		badges_data:'badge_img_name, badge_name, client_id, client_name, created_at, created_by, created_ts, deleted_at, emp_code, id,'+
					' mobile_no, status, updated_at, upload_id, user_id, user_name',
		leaderboard_data: 'client_id, client_name, created_at, created_by, created_ts, deleted_at, emp_code, id, mobile_no,  obj2_list_id'+
					'obj_list_id, obj_text, points, rank, region, status, territory, updated_at, updated_by, upload_id, user, user_id, user_name'+
					'zone',
		
	});
	
	db.on("populate", function() {
        db.client_data.add({id: 1, client_logo_ext: ".png", client_name: "JKTyre", program_name: "TEST" });
    });
    
	db.open().then(function(){
		console.log(db.client_data.toArray());
	});
			
	db.client_data.toArray()
				  .then(function (client_dat) {
					console.log(client_dat.client_name);
				  });
  
	*/
  
  var app = {
	isLoading: true,
	spinner: document.querySelector('.loader'),
    container: document.querySelector('.main'),
	initialData: {"pagename": "My Objectives",
				  "points": "0",
				  "name":"Loading...",
				  "lastupdate":"00-00-0000",
				  "daysleft":"",
				  "toolbardata":"Loading..."
				 },
    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
				  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
	
  };
  app.loadeddata=false;
  
  // for google graphs
		// Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart','bar']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
	
  function drawChart() {
		if(app.loadeddata){
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
	  
  
	 
  
  
  // for first run
  
  function loadnavdefaults(){
	  var d = new Date();
	  //var firstDay = new Date(d.getFullYear(), d.getMonth(), 1);
	  var lastDay = new Date(d.getFullYear(), d.getMonth() + 1, 0);
	  $('.pageheading').html(app.initialData.pagename);
	  $('.monthyear').html(app.monthNames[d.getMonth()]+" "+d.getFullYear());
	  $('.daysremaining').html(lastDay.getDate()-d.getDate());
  }
  
  function loadnav(data){
	  loadnavdefaults();
	  
	  $('.points').html('Total Points: '+data.points);
	  $('.lastupdate').html(data.lastupdate);
	  $('.headingname').html(app.initialData.name);
	  $('.toolbar').html(data.toolbardata);
	  
  }
  app.updateCards=function (cardData){
	 $('.cards').empty();
	 
	for(var i=0;i<cardData.length;i++){
		//console.log(cardData[i].objective_type);
		switch(cardData[i].objective_type){
			case "QUANTITY":
							var qty = document.querySelector('.qty').cloneNode(true);
							qty.classList.remove('qty');
							qty.classList.add(cardData[i].id);
							document.querySelector('.cards').appendChild(qty);
							$('.'+cardData[i].id).attr('onclick',"window.location.assign(apiurl+'/dashboard/leaderboard');");
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
							document.querySelector('.cards').appendChild(target);
							$('.'+cardData[i].id).attr('onclick',"window.location.assign(apiurl+'/dashboard/leaderboard');");
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
							document.querySelector('.cards').appendChild(range);
							$('.'+cardData[i].id).attr('onclick',"window.location.assign(apiurl+'/dashboard/leaderboard');");
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
		
	}
	setTimeout(function() {
		drawChart();
	},500);
	
  };
  
  
  //loading data to ui
  
	app.updateIndexDataToUi=function(data){
		loadnavdefaults();
	  $('.points').html('Total Points: '+data.user_data.user_points);
	  $('.lastupdate').html(data.client_last_updated);
	  $('.headingname').html(data.user_data.name);
	  $('.toolbar').html(data.client_data.program_name);
	  app.loadeddata=true;
	  app.updateCards(data.obj_data);
	  app.obj_data=data.obj_data;
	  //app.loadeddata=true;
	  //drawChart();
	  if(app.isLoading){
		app.isLoading=false;
		$('.loader').fadeOut('slow');
		$('.cards').removeAttr('hidden');
		$('.cards').fadeIn(10000);
	  }
	  // load data to local storage for future use
	  localStorage.client_last_updated=JSON.stringify(data.client_last_updated);
	  localStorage.obj_data=JSON.stringify(data.obj_data);
	  localStorage.user_data=JSON.stringify(data.user_data);
	  localStorage.badges_data=JSON.stringify(data.badges_data);
	  localStorage.leaderboard_data=JSON.stringify(data.leaderboard_data);
	  localStorage.client_data=JSON.stringify(data.client_data);
	  
	}
  
  
 //getting data from ajax 
  app.getData=function(){
	var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if (request.readyState === XMLHttpRequest.DONE) {
        if (request.status === 200) {
			var response = JSON.parse(request.response);
			console.log(response);
			app.updateIndexDataToUi(response);
        }
      }
    };
    request.open('GET', apiurl+'/quick/getindexdata');
    request.send();
  }

  
  
  
  
  // for first run
  if(!localStorage.client_last_updated){
	  console.log('initial');
	  loadnav(app.initialData);
	
  }else{
	  console.log('old');
	  app.user_data=JSON.parse(localStorage.user_data);
	  app.client_last_updated=JSON.parse(localStorage.client_last_updated);
	  app.client_data=JSON.parse(localStorage.client_data);
	  app.obj_data=JSON.parse(localStorage.obj_data);
	  console.log(app.obj_data);
	  loadnavdefaults();
	  $('.points').html('Total Points: '+app.user_data.user_points);
	  $('.lastupdate').html(app.client_last_updated);
	  $('.headingname').html(app.user_data.name);
	  $('.toolbar').html(app.client_data.program_name);
	  app.loadeddata=true;
	  app.updateCards(app.obj_data);
	  	
	  if(app.isLoading){
		app.isLoading=false;
		$('.loader').fadeOut('slow');
		$('.cards').removeAttr('hidden');
		$('.cards').fadeIn(10000);
	  }
  }
  app.getData();  
  
  
  //events
  //signout click
  $('.signout').click(function(e){
	 e.preventDefault(); 
	 localStorage.clear();
	 window.location.assign(apiurl+'/vault/logout');
  });
  
  
  
  

if('serviceWorker' in navigator) {
    navigator.serviceWorker
             .register('http://localhost/worxogo/service-worker.js',{ insecure: true, scope: '/worxogo/' })
             .then(function() { console.log('Service Worker Registered'); })
			 .catch(function(err){
				 console.log('service worker failed to register '+ err);
			 })
  }
  
  
  
  $(window).resize(function(){
        drawChart();
       
      });
}(jQuery));