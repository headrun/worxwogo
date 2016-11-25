
(function($) {
  'use strict';
  
  var profileapp = {
	isLoading: true,
	spinner: document.querySelector('.loader'),
    container: document.querySelector('.main'),
	initialData: {"lastupdate":"00-00-0000",
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
	  $('.monthyear').html(profileapp.monthNames[d.getMonth()]+" "+d.getFullYear());
	  $('.daysremaining').html(lastDay.getDate()-d.getDate());
  }
  
  function loadnav(data){
	  loadnavdefaults();
	  $('.lastupdate').html(data.lastupdate);
	  $('.toolbar').html(data.toolbardata);
  }
  
  profileapp.updateIndexDataToUi=function(data) {
	  data.toolbardata=data.client_data.program_name;
	  data.lastupdate=data.client_last_updated;
	  loadnav(data);
	  $('.badgeimgs').empty();
	  if(data.badges_data.length > 0){
		  $('.stillbadge').hide();
		for(var i=0; i<data.badges_data.length; i++){
		  var badge = document.querySelector('.badgetemplate').cloneNode(true);
		  badge.classList.remove('badgetemplate');
		  badge.classList.add(data.badges_data[i].id);
		  document.querySelector('.badgeimgs').appendChild(badge);
		  $('.'+data.badges_data[i].id).children('.badges').attr('src',apiurl+'/assets/img/Badges/'+data.badges_data[i].badge_img_name);
		  $('.'+data.badges_data[i].id).children('.badgename').html(data.badges_data[i].badge_name);
		}
	  }else{
		  $('.stillbadge').show();
	  }
	  $('.mobileno').html(data.user_data.mobilenumber);
	  $('.designation').html(data.user_data.designation);
      $('.territory').html(data.user_data.territory);
	  $('.region').html(data.user_data.region);
	  
	  //inserting/updating data to local storage
	  
	  localStorage.client_last_updated=JSON.stringify(data.client_last_updated);
	  localStorage.badges_data=JSON.stringify(data.badges_data);
	  localStorage.user_data=JSON.stringify(data.user_data);
	  localStorage.client_data=JSON.stringify(data.client_data);
  }
  
  
  profileapp.getData=function(){
	var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if (request.readyState === XMLHttpRequest.DONE) {
        if (request.status === 200) {
			var response = JSON.parse(request.response);
			console.log(response);
			profileapp.updateIndexDataToUi(response);
        }
      }
    };
    request.open('GET', apiurl+'/quick/getprofiledata');
    request.send();
	
  }
  
  profileapp.updateUserData=function(user_data){
	  
	  $('.mobileno').html(user_data.mobilenumber);
	  $('.designation').html(user_data.designation);
      $('.territory').html(user_data.territory);
	  $('.region').html(user_data.region);
	  
	  
  }
  
  profileapp.updateoldBadgesData=function(badges_data){
	  $('.badgeimgs').empty();
	  if(badges_data.length > 0){
		  $('.stillbadge').hide();
		for(var i=0; i<badges_data.length; i++){
		  var badge = document.querySelector('.badgetemplate').cloneNode(true);
		  badge.classList.remove('badgetemplate');
		  badge.classList.add(badges_data[i].id);
		  document.querySelector('.badgeimgs').appendChild(badge);
		  $('.'+badges_data[i].id).children('.badges').attr('src',apiurl+'/assets/img/Badges/'+badges_data[i].badge_img_name);
		  $('.'+badges_data[i].id).children('.badgename').html(badges_data[i].badge_name);
		}
	  }else{
		  $('.stillbadge').show();
	  }
  }
  
  
  //main controllers
  if(!localStorage.badges_data){
	  console.log('initial');
	  loadnav(profileapp.initialData);
  }else{
	  
	  console.log('old')
	  profileapp.badges_data=JSON.parse(localStorage.badges_data);
	  profileapp.user_data=JSON.parse(localStorage.user_data);
	  profileapp.client_last_updated=JSON.parse(localStorage.client_last_updated);
	  profileapp.client_data=JSON.parse(localStorage.client_data);
	  loadnavdefaults();
	  $('.lastupdate').html(profileapp.client_last_updated);
	  $('.toolbar').html(profileapp.client_data.program_name);
	  $('.username').html(profileapp.user_data.name);
	  profileapp.updateUserData(profileapp.user_data);
	  profileapp.updateoldBadgesData(profileapp.badges_data);
  }
  	
	  if(profileapp.isLoading){
		profileapp.isLoading=false;
		$('.loader').fadeOut('slow');
		$('.cards').removeAttr('hidden');
		$('.cards').fadeIn(10000);
	  }
  console.log('gotdatafromdb')
  profileapp.getData();
  
  
   
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