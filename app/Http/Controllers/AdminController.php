<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Excel;
use Input;
use DB;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Clients;
use App\Objective;
use App\User;
use App\Uploadstatus;
use App\Objectiveleaderboard;
use App\Objectiveprogress;
use App\Errobjlist;
use App\Erruserlist;
use App\Errleaderboardlist;
use App\Errobjectiveprogresslist;
use App\Badges;
use App\Errbadges;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $currentPage  =  "";
            $mainMenu     =  "DASHBOARD";
            $viewData = array('currentPage', 'mainMenu',);
            return view('admindashboard/index',compact($viewData));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function uploads(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $currentPage  =  "OBJECTIVES_LIST";
            $mainMenu     =  "UPLOADS_MAIN";
            $clients=Clients::all();
            $viewData = array('currentPage', 'mainMenu','clients');
            return view('admindashboard/uploads',compact($viewData));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    static public function checkforcolumn($columncheckdata,$row){
        for($j=0;$j<count($columncheckdata);$j++){
            
            if(!(isset($row[$columncheckdata[$j]]) || array_key_exists($columncheckdata[$j],$row))){
              return $columncheckdata[$j];
            }
        }
        return 1;
    }
    
    static public function checkfordata($rowdata,$columnnames){
        for($j=0;$j<count($columnnames);$j++){
            if((strlen($rowdata[$columnnames[$j]])==0)){
                return $columnnames[$j];
            }
        }
        return 1;
    }
    
    static public function rowemtycheck($row,$columnnames){
        for($j=0;$j<count($row);$j++){
            
            if(!is_null($row[$columnnames[$j]])){
                return 0;
            }
        }
        return 1;
    }
    
    public function uploaddata(Request $request){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $inputs = $request->all();

           // Checking for File Read Error
            try{
                $data=Excel::load( Input::file('uploadextract'), function($reader) {
                   
                })->get();
            } catch (\Exception $e) {
                return Response::json(array('status'=>'error','type'=>'File Read Error','Debug exception'=>$e));
            }
            
          // Getting data for  client name checking
            if((isset($inputs['client']) && ($inputs['client']!="") )){
                $clientdata=  Clients::find(($inputs['client']));
            }else{
                return  Response::json(array('status'=>'error','type'=>'please select the Company'));
            }
          //fields for eachtable
            $columnnames['objectivelist']=['objective_no','objective_text','status','created_ts','client_name'];
            $columnnames['userslist']    =['user_name','user_mobile','user_emp_code','territory','reporting_user',
                                           'reporting_name','reporting_desg','user_level_name','user_level_image_name',
                                           'user_points','created_ts','status','region','designation','client_name'];
            $columnnames['leaderboard']  =['user_name','user_employee_code','objective_no','objective_text','region',
                                           'territory','client_name','user_mobile_no','user_rank','user_points','created_ts',
                                           'status'];
            $columnnames['objectiveextract']=['user_name','user_mobile_no','user_employee_code','objective_no','objective_text','data_type',
                                              'objective_type','target_obj_month','target_obj_value','target_obj_ach_per',
                                              'target_obj_ach_value','target_obj_tobe_ach_per','target_obj_tobe_ach_value',
                                              'target_obj_value_units','target_obj_skew_indicator','target_obj_skew_target',
                                              'seg_obj_start_value','seg_obj_end_value','seg_obj_start_per','seg_obj_end_per',
                                              'seg_obj_value_units','seg_obj_good_start_per','seg_obj_good_end_per',
                                              'seg_obj_bad_start_per','seg_obj_bad_end_per','seg_obj_vgood_start_per',
                                              'seg_obj_vgood_end_per','seg_obj_ach_value','seg_obj_target_value',
                                              'seg_obj_target_value_units','seg_obj_txt','qty_highest_ach_no',
                                              'qty_current_ach_no','qty_value_units','objective_points',
                                              'created_ts','status','client_name'];
            $columnnames['badgesextract']=['user_name','user_mobile_no','user_employee_code','user_badge_name',
                                            'user_badge_image_name','created_ts','status','client_name'];
            
                                        
         // Selecting the table and validating the colums and inserting to db
            switch($inputs['uploadType']){
            case 'objectivelist': 
                                 $uploadstatusdata['insert_table']='OBJECTIVE_LIST';
                                 $uploadstatusdata['client_id']=$inputs['client'];
                                 $uploadstatusdata['status']='FAILURE';
                                 if(!empty($data) && $data->count()){
                                    
                                    
                                        for($i=0;$i<count($data);$i++){
                                            //checking for all the fields exists in objectivelist
                                            
                                            
                                            $columnstatus=AdminController::checkforcolumn($columnnames['objectivelist'],$data[$i]);
                                            if(($columnstatus==1)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Objective::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['objectivelist']);
                                                if(($datacheck == '1' )&&($data[$i]['client_name']==$clientdata->client_name)){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $objective =  Objective::insertObjective($data[$i],$data2);
                                                     $error=0;
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['objectivelist']);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $data[$i]['error']='Row'.$data[$i].'[ Data Validation Error on column '.$datacheck.' ]';
                                                    $error=1;
                                                    $errobj_list=Errobjlist::insertobjerrlist($data[$i],$data2);
                                                    }
                                                }
                                            }else{
                                            // Column not found error
                                               return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                            }
                                        }
                                        if(!$error){
                                            $upload_status->status='SUCCESS';
                                            $upload_status->save();
                                            return  Response::json(array('status'=>'success'));
                                        }else{
                                            return  Response::json(array('status'=>'Failure','type'=>'inserted to error logtable'));
                                        }
                                            
                                                    
                                    
                                 }
                                 break;
            case 'userextract':
                
                                $uploadstatusdata['insert_table']='USER';
                                $uploadstatusdata['client_id']=$inputs['client'];
                                $uploadstatusdata['status']='FAILURE';
                                 
                                if(!empty($data) && $data->count()){
                                   
                                        for($i=0;$i<count($data);$i++){
                                            //checking for all the fields exists in objectivelist
                                            $columnstatus=AdminController::checkforcolumn($columnnames['userslist'],$data[$i]);
                                            if(($columnstatus==1)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    User::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['userslist']);
                                                if(($datacheck == '1' )&&(!strcmp($data[$i]['client_name'],$clientdata->client_name))){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    
                                                    $users = User::insertUsers($data[$i],$data2);
                                                    
                                                     $error=0;
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['userslist']);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                        $data2['client_id']=$clientdata->id;
                                                        $data2['upload_id']=$upload_status->id;
                                                        $error=1;
                                                        $data[$i]['error']='Row'.$data[$i].'[ Data Validation Error on column '.$datacheck.' ]';
                                                        $errobj_list=Erruserlist::insertusererrlist($data[$i],$data2);
                                                    }
                                                    
                                                }
                                     }else{
                                            // Column not found error
                                               return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                        }
                                    }
                                        if(!$error){
                                            $upload_status->status='SUCCESS';
                                            $upload_status->save();
                                            return  Response::json(array('status'=>'success'));
                                        }else{
                                            return  Response::json(array('status'=>'Failure','type'=>'inserted to error logtable'));
                                        }
                                     
                                 }
                                 break;
                                 
            case 'objectiveextract':
                                $uploadstatusdata['insert_table']='OBJECTIVES_PROGRESS';
                                $uploadstatusdata['client_id']=$inputs['client'];
                                $uploadstatusdata['status']='FAILURE';
                                if(!empty($data) && $data->count()){
                                    
                                        
                                        for($i=0;$i<count($data);$i++){
                                            //return Response::json($data[$i]);
                                            //checking for all the fields exists in objectivelist
                                            $columnstatus=AdminController::checkforcolumn($columnnames['objectiveextract'],$data[$i]);
                                            if(($columnstatus==1)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Objectiveprogress::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['objectiveextract']);
                                                if(($datacheck == '1' )&&($data[$i]['client_name']==$clientdata->client_name)){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $users = Objectiveprogress::insertobjectiveprogress($data[$i],$data2);
                                                    $error=0;
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['objectiveextract']);
                                                    if(!$rowemptycheck){
                                                        // Data Validation Error insert to Error table
                                                        $data2['client_id']=$clientdata->id;
                                                        $data2['upload_id']=$upload_status->id;
                                                        $data[$i]['error']='Row'.$data[$i].'[ Data Validation Error on column '.$datacheck.' ]';
                                                        $error=1;
                                                        $errobj_list=Errobjectiveprogresslist::inserterrobjectiveprogresslist($data[$i],$data2);
                                                    }
                                                }
                                            }else{
                                            // Column not found error
                                               return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                        }
                                        }
                                        if(!$error){
                                            $upload_status->status='SUCCESS';
                                            $upload_status->save();
                                            return  Response::json(array('status'=>'success'));
                                        }else{
                                            return  Response::json(array('status'=>'Failure','type'=>'inserted to error logtable'));
                                        }
                                     
                                 }
                                 break;
            case 'badgesextract':
                                 $uploadstatusdata['insert_table']='BADGES';
                                 $uploadstatusdata['client_id']=$inputs['client'];
                                 $uploadstatusdata['status']='FAILURE';
                                 if(!empty($data) && $data->count()){
                                    
                                    
                                        for($i=0;$i<count($data);$i++){
                                            //checking for all the fields exists in objectivelist
                                            
                                            
                                            $columnstatus=AdminController::checkforcolumn($columnnames['badgesextract'],$data[$i]);
                                            if(($columnstatus==1)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Badges::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                    
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['badgesextract']);
                                                if(($datacheck == '1' )&&($data[$i]['client_name']==$clientdata->client_name)){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $badges =  Badges::insertBadges($data[$i],$data2);
                                                     $error=0;
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['badgesextract']);
                                                    //return Response::json($rowemptycheck);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $data[$i]['error']='Row'.$data[$i].'[ Data Validation Error on column '.$datacheck.' ]';
                                                    $error=1;
                                                    $errobj_list=Errbadges::insertbadgeserrlist($data[$i],$data2);
                                                    }
                                                }
                                            }else{
                                            // Column not found error
                                               return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                            }
                                        }
                                        if(!$error){
                                            $upload_status->status='SUCCESS';
                                            $upload_status->save();
                                            return  Response::json(array('status'=>'success'));
                                        }else{
                                            return  Response::json(array('status'=>'Failure','type'=>'inserted to error logtable'));
                                        }
                                            
                                                    
                                    
                                 }
                                break;
            case 'leaderboardextract':
                                $uploadstatusdata['insert_table']='OBJECTIVE_LEADERBOARD';
                                $uploadstatusdata['client_id']=$inputs['client'];
                                $uploadstatusdata['status']='FAILURE';
                                 
                                if(!empty($data) && $data->count()){
                                    
                                        for($i=0;$i<count($data);$i++){
                                            //checking for all the fields exists in objectivelist
                                            $columnstatus=AdminController::checkforcolumn($columnnames['leaderboard'],$data[$i]);
                                            if(($columnstatus==1)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Objectiveleaderboard::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['leaderboard']);
                                                if(($datacheck == '1' )&&($data[$i]['client_name']==$clientdata->client_name)){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $users =  Objectiveleaderboard::insertleadObjective($data[$i],$data2);
                                                     $error=0;
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['leaderboard']);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $data[$i]['error']='Row'.$data[$i].'[ Data Validation Error on column '.$datacheck.' ]';
                                                    $error=1;
                                                    $errobj_list=Errleaderboardlist::insertleaderboarderrlist($data[$i],$data2);
                                                    }
                                                }
                                     }else{
                                            // Column not found error
                                               return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                        }
                                    }
                                        if(!$error){
                                            $upload_status->status='SUCCESS';
                                            $upload_status->save();
                                            return  Response::json(array('status'=>'success'));
                                        }else{
                                            return  Response::json(array('status'=>'Failure','type'=>'inserted to error logtable'));
                                        }
                                     
                                 }
                                 break;
            default:
                                
                                break;
                            
            }
            return Redirect::action('AdminController@uploads');
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
