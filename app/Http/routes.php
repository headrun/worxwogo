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
Route::get('/',"VaultController@register" );

//***************************** Login and Register Routes *******************//
Route::group(array('prefix' => 'vault'), function() {
    //User Login
    Route::any('Register', "VaultController@register");
    // Admin Login
    Route::any('adminlogin', "VaultController@adminLogin");
    
    Route::get('logout', "VaultController@logout");	
    
});

//***************************** Dashboard Routes ****************************//
Route::group(array('prefix' => 'dashboard'), function() {
    Route::get('/index', "DashboardController@index");
    Route::get('/profile',"DashboardController@profile");
    Route::get('/leaderboard',"DashboardController@leaderboard");
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


//***************************** Admin Post Routes ****************************//
//Route::post('uploaddata','AdminController@uploaddata');
Route::post('addusers','UserController@uploadUsers');
Route::post('addobjectives','ObjectiveController@uploadObjectives');
Route::post('addobjectiveprogress','ObjectiveController@uploadObjectiveprogress');


Route::group(array('prefix' => 'quick'), function() {
    
    Route::any('/uploaddata','AdminController@uploaddata');
    
    Route::any('/deleteCompanyById','DashboardController@deleteCompany');
    Route::any('/editCompanyById','DashboardController@editCompany');
    Route::any('/addClient','DashboardController@addnewCompany');
    Route::any('/getobjlist','DashboardController@getobjlist');
    Route::any('/getreportdata','DashboardController@getreportdata');
});