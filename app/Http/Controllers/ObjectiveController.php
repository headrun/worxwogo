<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Excel;
use Input;
use DB;
use App\User;
use App\Objective;
use App\Objectiveprogress;
use App\Objectivesegmentation;
use App\Uploadstatus;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ObjectiveController extends Controller
{
    
    
    
    
    public function addobjective(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $objective_data=  Objective::where('client_id','=',Session::get('clientId'))->where('status','=','A')->get();
            $dataToView = array('objective_data');
            return view('admindashboard/addobjective',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
        
    }
    
    
//    
//    public function objectiveprogress(){
//        if(Auth::check() && (Session::get('userType')=='ADMIN')){
//            $objective_progress_data= Objectiveprogress::where('client_id','=',Session::get('clientId'))->get();
//            $dataToView = array('objective_progress_data');
//            return view('admindashboard/objectiveprogress',compact($dataToView));
//        }else{
//            return Redirect::action('VaultController@logout');
//        }
//    }
    
//    public function objectivesegmentation(){
//        if(Auth::check() && (Session::get('userType')=='ADMIN')){
//            $objective_progress_data= Objectiveprogress::where('client_id','=',Session::get('clientId'))->get();
//            $dataToView = array('objective_progress_data');
//            return view('admindashboard/objectiveprogress',compact($dataToView));
//        }else{
//            return Redirect::action('VaultController@logout');
//        }
//        
//    }
    
//    
//    public function uploadObjectives(){
//        if(Auth::check() && (Session::get('userType')=='ADMIN')){
//            $data=Excel::load( Input::file('user'), function($reader) {
//            })->get();
//            if(!empty($data) && $data->count()){
//                foreach ($data as $rows) {
//                    foreach($rows as $row){
//                        //checking for all the fields
//                        
//                            $insert[] = ['objectivename'=>$row->objectivename];
//                                          
//                    }
//                 }
//                if(!empty($insert)){
//                    
//                    //insert into upload_status table
//                    $data['insert_table']='OBJECTIVE_MASTER';
//                    $upload_status_id=Uploadstatus::insertuploadstatus($data);
//                    
//                    $z=0;
//                    for($i=0;$i<count($insert);$i++){
//                        
//                        if(strlen($insert[$i]['objectivename'])){
//                            $objectiveData['objectivename']=$insert[$i]['objectivename'];
//                            $objectiveData['upload_id']=$upload_status_id->id;
//                            $objective =  Objective::insertObjective($objectiveData);
//                            
//                        }else{
//                            $failure[$z]['status']='failure';
//                            $failure[$z]['objectivename']=$insert[$i]['objectivename'];
//                            $z++;
//                        }
//                    }
//                    
//                }
//            }
//            if(isset($failure)){
//                
//                $dataToView = array('failure');
//                //return View::make('status/failure', compact($dataToView));
//                
//            }else{
//                return Redirect::action('UserController@success');
//                
//            }
//            
//        }
//    }
    
//    static public function uploadObjectiveprogress(){
//        if(Auth::check() && (Session::get('userType')=='ADMIN')){
//            $data=Excel::load( Input::file('user'), function($reader) {
//            })->get();
//            if(!empty($data) && $data->count()){
//                foreach ($data as $rows) {
//                    foreach($rows as $row){
//                        //checking for all the fields
//                        
//                            $insert[] = ['userid'=>$row->userid,'objectiveid'=>$row->objectiveid,'targetpts'=>$row->targetpoints,'ptstillnow'=>$row->pointstillnow];
//                                          
//                    }
//                 }
//                if(!empty($insert)){
//                    
//                    //insert into upload_status table
//                    $data['insert_table']='OBJECTIVE_PROGRESS';
//                    $upload_status_id=Uploadstatus::insertuploadstatus($data);
//                    
//                    $z=0;
//                    for($i=0;$i<count($insert);$i++){
//                        
//                        if(strlen($insert[$i]['userid']) || strlen($insert[$i]['objectiveid']) 
//                                || strlen($insert[$i]['targetpts']) || strlen($insert[$i]['ptstillnow'])){
//                            $objectiveData['userid']=$insert[$i]['userid'];
//                            $objectiveData['objectiveid']=$insert[$i]['objectiveid'];
//                            $objectiveData['upload_id']=$upload_status_id->id;
//                            $objectiveData['targetpts']=$insert[$i]['targetpts'];
//                            $objectiveData['pts_tillnow']=$insert[$i]['ptstillnow'];
//                            $objective =  Objectiveprogress::insertObjectiveprogress($objectiveData);
//                            
//                        }else{
//                            $failure[$z]['status']='failure';
//                            $failure[$z]['objectivename']=$insert[$i]['objectivename'];
//                            $z++;
//                        }
//                    }
//                    
//                }
//            }
//            if(isset($failure)){
//                
//                $dataToView = array('failure');
//                //return View::make('status/failure', compact($dataToView));
//                
//            }else{
//                return Redirect::action('UserController@success');
//                
//            }
//            
//        }
//    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
