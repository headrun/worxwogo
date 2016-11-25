(function($) {
  'use strict';
  
  var leaderboardapp = {
	isLoading: true,
	spinner: document.querySelector('.loader'),
    container: document.querySelector('.main'),
	initialData: {"pagename": "Objectives Leaderboard",
				  "points": "0",
				  "name":"Loading...",
				  "lastupdate":"00-00-0000",
				  "daysleft":"",
				  "toolbardata":"Loading..."
				 },
    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
				  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
  };
  
  

  // first load
  function loadnavdefaults(){
	  var d = new Date();
	  //var firstDay = new Date(d.getFullYear(), d.getMonth(), 1);
	  var lastDay = new Date(d.getFullYear(), d.getMonth() + 1, 0);
	  $('.monthyear').html(leaderboardapp.monthNames[d.getMonth()]+" "+d.getFullYear());
	  $('.daysremaining').html(lastDay.getDate()-d.getDate());
	  $('.points').html('Total Points: '+leaderboardapp.initialData.points);
	  
  }
  
  function loadnav(data){
	  loadnavdefaults();
	  $('.points').html('Total Points: '+data.points);
	  $('.lastupdate').html(data.lastupdate);
	  $('.toolbar').html(data.toolbardata);
	  
  }
  
  
  
  function updateLeaderboardData(data){
	  console.log(data);
	  $('.table').empty();
	  var leaderboardheading="<thead>"+
							 "<tr>"+
							 "<td class='name'><h4 class='trdata'>Rank</h4></td>"+
							 "<td class='name'><h4 class='trdata'>Name</h4></td>"+
							 "<td class='name'><h4 class='trdata'>Territory</h4></td>"+
							 "<td class='name'><h4 class='text-right trdata'>Points</h4></td>"+
							 "</tr>"+
							 "</thead>";
	  $('.table').append(leaderboardheading);
	for(var i=0;i<data.length;i++){
		var leaderboard = "<tbody><tr valign='middle' class="+data[i].id+">";
		leaderboard+="<td class='name rank'><h4>"+data[i].rank+"</h4></td>"+
					 "<td class='name user_name'><h4>"+data[i].user_name+"</h4></td>"+
					 "<td class='name territory'><h4>"+data[i].territory+"</h4></td>"+
					 "<td class='leadpoints text-right'><h4>"+data[i].points+"</h4></td>"+
					 "</tr></tbody>";
		$('.table').append(leaderboard);
	}
  }
  
  leaderboardapp.updateIndexDataToUi=function(data) {
	  data.toolbardata=data.client_data.program_name;
	  var temp={};
	  temp.lastupdate=data.client_last_updated;
	  temp.toolbardata=data.client_data.program_name;
	  temp.points=data.user_data.user_points;
	  temp.name=data.user_data.name;
	  
	  loadnav(temp);
	  $('.headingname').html(data.user_data.name);
	  
	  updateLeaderboardData(data.leaderboard_data);
	  
	  //inserting/updating data to local storage
	  
	  localStorage.client_last_updated=JSON.stringify(data.client_last_updated);
	  localStorage.leaderboard_data=JSON.stringify(data.leaderboard_data);
	  localStorage.user_data=JSON.stringify(data.user_data);
	  localStorage.client_data=JSON.stringify(data.client_data);
  }
  
  
  leaderboardapp.getData=function(){
	var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if (request.readyState === XMLHttpRequest.DONE) {
        if (request.status === 200) {
			var response = JSON.parse(request.response);
			console.log(response);
			leaderboardapp.updateIndexDataToUi(response);
        }
      }
    };
    request.open('GET', apiurl+'/quick/getleaderboarddata');
    request.send();
	
  }
  
  
  //main controllers
  if(!localStorage.leaderboard_data){
	  console.log('initial');
	  loadnav(leaderboardapp.initialData);
	  $('.headingname').html(leaderboardapp.initialData.name);
  }else{  
	  console.log('old')
	  leaderboardapp.leaderboard_data=JSON.parse(localStorage.leaderboard_data);
	  leaderboardapp.user_data=JSON.parse(localStorage.user_data);
	  leaderboardapp.client_last_updated=JSON.parse(localStorage.client_last_updated);
	  leaderboardapp.client_data=JSON.parse(localStorage.client_data);
	  loadnavdefaults();
	  $('.lastupdate').html(leaderboardapp.client_last_updated);
	  $('.toolbar').html(leaderboardapp.client_data.program_name);
	  $('.headingname').html(leaderboardapp.user_data.name);
	  
	  updateLeaderboardData(leaderboardapp.leaderboard_data);
  }
  	
	  if(leaderboardapp.isLoading){
		leaderboardapp.isLoading=false;
		$('.loader').fadeOut('slow');
		$('.cards').removeAttr('hidden');
		$('.cards').fadeIn(10000);
	  }
  console.log('gotdatafromdb')
  leaderboardapp.getData();
  
  
    //events
  
  $('.signout').click(function(e){
	 e.preventDefault(); 
	 localStorage.clear();
	 window.location.assign(apiurl+'/vault/logout');
  });
  
  
  
  
if('serviceWorker' in navigator) {
    navigator.serviceWorker
             .register('/worxogo/service-worker.js')
             .then(function() { console.log('Service Worker Registered'); });
  }
  
}(jQuery));