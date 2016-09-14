<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Uploadstatus;
use App\Clients;
use App\User;
use App\Objective;
use App\Objectiveprogress;
use App\Objectiveleaderboard;
use App\Badges;
use DB;
use Response;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            
            $objective_data=Objectiveprogress::getobjectivedata();
            
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
            $user=User::find(Session::get('userId'));
            $client_data=Clients::find(Session::get('clientId'));
            $dataToView = array('objective_data','client_last_updated','user','client_data');
            return view('/dashboard/index',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    
    public function addcompany(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $currentPage  =  "";
            $mainMenu     =  "ADDCOMPANY";
            
            $clients_data=Clients::all();
            /* SELECT DISTINCT (`client_id`) as `s`, (SELECT COUNT(`s`) FROM `users` WHERE `client_id`= `s`) as `count` FROM `users` */
            
            for($i=0;$i<count($clients_data);$i++){
                $clients_data[$i]['totalusers']= User::where('client_id','=',$clients_data[$i]['id'])->count();
            }
            
            $dataToView = array('currentPage','mainMenu',
                                'clients_data');
            return view('/admindashboard/addcompany',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function addnewCompany(Request $request){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $inputs = $request->all();
            $file=Input::file('uploadextract');
            
            
            $data['client_name']=$inputs['company_name'];
            $data['status']=$inputs['status'];
            $newclient=  Clients::addnewClient($data);
            
            $destinationPath = 'assets/img/logo/';
            $fileExtension = '.'.$file->getClientOriginalExtension();
            $filename = $newclient->id.$fileExtension;
            $temp=Clients::find($newclient->id);
            $temp->client_logo_ext=$fileExtension;
            $temp->save();
            $result = Input::file('uploadextract')->move($destinationPath, $filename);
		
            return Response::json(array('status'=>'success'));
        }
    }
    public function deleteCompany(Request $request){
        //return Response::json(array('status'=>'success'));
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $inputs = $request->all();
            $clientdata=Clients::find($inputs['delete_id']);
            $clientdata->delete();
            return Response::json(array('status'=>'success'));
        }
    }
    public function editCompany(Request $request){
        //return Response::json(array('status'=>'success'));
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $inputs = $request->all();
            $clientdata=Clients::find($inputs['company_id']);
            $clientdata->client_name=$inputs['company_name'];
            $clientdata->status=$inputs['status'];
            $clientdata->save();
            return Response::json(array('status'=>'success'));
        }
    }
    
    
    
    public function profile(){
        if(Auth::check()){
            $userdata=User::where('mobilenumber','=',Session::get('mobileNumber'))->where('client_id','=',Session::get('clientId'))->get();
            $userdata=$userdata[0];
            $badges_data= Badges::where('mobile_no','=',Session::get('mobileNumber'))->where('client_id','=',Session::get('clientId'))->get();
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
             $user=User::find(Session::get('userId'));
             $client_data=Clients::find(Session::get('clientId'));
            $dataToView = array('userdata','client_last_updated','user','badges_data','client_data');
            return view('/dashboard/profile',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function leaderboard(){
        if(Auth::check()){
            $objleaderboarddata=Objectiveleaderboard::getobjleaddata();
            for($i=0;$i<count($objleaderboarddata);$i++){
                
                $objleaderboarddata[$i]['user']=User::where('mobilenumber','=',$objleaderboarddata[$i]['mobile_no'])->get();
              
            }
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
    
            $user=User::find(Session::get('userId'));
            $client_data=Clients::find(Session::get('clientId'));
            $dataToView = array('objleaderboarddata','client_last_updated','user','client_data');
            return View ('/dashboard/leaderboard',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }

    
    public function viewobjectives(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $currentPage  =  "";
            $mainMenu     =  "VIEWOBJECTIVES";
            $client_data=Clients::orderBy('id','desc')->get();
            $dataToView = array('currentPage','mainMenu','client_data');
            
            return View('/admindashboard/viewobjectives',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function reports(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $currentPage  =  "";
            $mainMenu     =  "REPORTS_MAIN";
            $client_data=Clients::orderBy('id','desc')->get();
            $dataToView = array('currentPage','mainMenu','client_data');
            return View('/admindashboard/reports',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function getobjlist(Request $request){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $inputs = $request->all();
            $objlist=Objective::where('client_id','=',$inputs['company_id'])->get();
            return Response::json(array('status'=>'success','objectivelist'=>$objlist));
        }
    }
    
    public function getreportdata(Request $request){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $inputs = $request->all();
            
            if($inputs['report_type']=='summaryreport'){
                $data=Uploadstatus::where('client_id','=',$inputs['company_id'])
                          ->whereDate('created_at','>=',$inputs['startdate'])
                          ->whereDate('created_at','<=',$inputs['enddate'])
                          ->get();
                return Response::json(array('status'=>'success','data'=>$data,'type'=>'summaryreport'));
            }else if($inputs['report_type']=='errorreport'){
                $data['object_list']['total']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','OBJECTIVE_LIST')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['object_list']['error']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','OBJECTIVE_LIST')
                                              ->where('status','=','FAILURE')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['user']['total']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','USER')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['user']['error']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','USER')
                                              ->where('status','=','FAILURE')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['object_progress']['total']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','OBJECTIVES_PROGRESS')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['object_progress']['error']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','OBJECTIVES_PROGRESS')
                                              ->where('status','=','FAILURE')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['badges']['total']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','BADGES')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['badges']['error']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','BADGES')
                                              ->where('status','=','FAILURE')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['leaderboard']['total']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','OBJECTIVE_LEADERBOARD')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                $data['leaderboard']['error']=Uploadstatus::where('client_id','=',$inputs['company_id'])
                                              ->where('insert_table','=','OBJECTIVE_LEADERBOARD')
                                              ->where('status','=','FAILURE')
                                              ->whereDate('created_at','>=',$inputs['startdate'])
                                              ->whereDate('created_at','<=',$inputs['enddate'])
                                              ->count();
                
                
                return Response::json(array('status'=>'success','data'=>$data,'type'=>'errorreport'));
            }
        }
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
