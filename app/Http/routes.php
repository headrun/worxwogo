<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//*********************************** Default Route *************************//
Route::get('/{company_name}',"VaultController@register" );
Route::get('/',"VaultController@def" );
Route::post('/login',"VaultController@login");
//***************************** Login and Register Routes *******************//
Route::group(array('prefix' => 'vault'), function() {
    
    Route::any('adminlogin', "VaultController@adminLogin");
    
    Route::get('logout', "VaultController@logout");	
    
});

//***************************** Dashboard Routes ****************************//
Route::group(array('prefix' => 'dashboard'), function() {
    Route::get('/index', "DashboardController@index");
    Route::get('/profile',"DashboardController@profile");
    Route::get('/leaderboard',"DashboardController@leaderboard");
    // supervisor app routes
    Route::get('/supervisorindex',"DashboardController@supervisorindex");
    Route::get('/sendmsg',"DashboardController@sendmsg");
    Route::get('/sendlike',"DashboardController@sendlike");
    Route::get('/supprofile',"DashboardController@supprofile");
    Route::get('/supervisorleaderboard/{obj_id}',"DashboardController@supleaderboard");
    Route::get('/supervisorleaderboard',"DashboardController@supleaderboardwithoutid");

    Route::get('/supleaderboardso/{so_empid}',"DashboardController@supleaderboardso");
    
});


//***************************** AdminDashboard Routes ****************************//
Route::group(array('prefix' => 'admindashboard'), function() {
    Route::get('/index', "AdminController@index");
    
    Route::get('/uploads', "AdminController@uploads");
    Route::get('/addcompany',"DashboardController@addcompany");
    Route::get('/viewobjectives',"DashboardController@viewobjectives");
    Route::get('/reports',"DashboardController@reports");
    
    Route::get('/addobjective',"ObjectiveController@addobjective");
    Route::get('/objectiveprogress','ObjectiveController@objectiveprogress');
    Route::get('/objectivesegmentation','ObjectiveController@objectivesegmentation');
    Route::get('/leaderboard',"DashboardController@leaderboard");
    Route::get('/addusers',"UserController@addUsers");
    
});

//***************************** Admin Status Routes ****************************//
Route::group(array('prefix' => 'status'), function() {
    Route::get('/success', "UserController@success");
    Route::get('/failure', "UserController@failure");
});

//error dump upload
Route::any('/errorupload/{upload_id}',"AdminController@dumperrorupload");

//***************************** Admin Post Routes ****************************//
//Route::post('uploaddata','AdminController@uploaddata');
Route::post('addusers','UserController@uploadUsers');
Route::post('addobjectives','ObjectiveController@uploadObjectives');
Route::post('addobjectiveprogress','ObjectiveController@uploadObjectiveprogress');




Route::group(array('prefix' => 'quick'), function() {

    //supervisor routes
    Route::any('getSupervisorDashboardData','DashboardController@getSupervisorDashboardData');
    Route::any('getSupervisorLeaderboardData',"DashboardController@getSupervisorLeaderboardData");
    Route::any('getSoDataForSupervisor',"DashboardController@getSoDataForSupervisor");
    Route::any('sendtextmsg',"DashboardController@sendtextmsg");

    //user routes
    Route::any('ajaxtest','DashboardController@ajaxtest');
    Route::any('/getindexdata','DashboardController@getindexdata');
    Route::any('/getprofiledata','DashboardController@getprofiledata');
    Route::any('/getleaderboarddata','DashboardController@getleaderboarddata');
    Route::any('/uploaddata','AdminController@uploaddata');
    
    Route::any('/deleteCompanyById','DashboardController@deleteCompany');
    Route::any('/editCompanyById','DashboardController@editCompany');
    Route::any('/addClient','DashboardController@addnewCompany');
    Route::any('/getobjlist','DashboardController@getobjlist');
    Route::any('/getreportdata','DashboardController@getreportdata');
    
    // Registation
    Route::any('/checkMobileNoforRegistration','VaultController@checkMobileNoforRegistration');
    Route::any('/checkOTPforRegistration','VaultController@checkOTPforRegistration');
    Route::any('/registeruser','VaultController@registeruser');
    
    Route::any('/checkmobilenumbervalid','VaultController@checkMobileNumberValidForChangePassword');
    Route::any('otppasswordcheckforforgotpassword','VaultController@otppasswordcheckforforgotpassword');
    Route::any('/UpdatePassword','VaultController@UpdatePassword');
});





Route::any('/t',function(){
   return Uploadstatus::where('insert_table','=','USER')->max('id'); 
});