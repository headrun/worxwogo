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
        return 'success';
    }
    
    static public function checkfordata($rowdata,$columnnames){
        for($j=0;$j<count($columnnames);$j++){
            if((strlen($rowdata[$columnnames[$j]])==0)){
                return $columnnames[$j]; 
            }
        }
        return 'success';
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
                                            if(($columnstatus === 'success')&&($data[$i]['client_name']===$clientdata->client_name)){
                                                
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $error=0;
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Objective::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['objectivelist']);
                                                if($datacheck == 'success'){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $objective =  Objective::insertObjective($data[$i],$data2);
                                                    if($error==0){
                                                     $error=0;
                                                    }
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['objectivelist']);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $data[$i]['error']='Data Validation Error on column '.$datacheck;
                                                    $error=1;
                                                    $errobj_list=Errobjlist::insertobjerrlist($data[$i],$data2);
                                                    }
                                                }
                                            }else{
                                                if($columnstatus != 'success'){
                                                      // Column not found error
                                                     return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                                    
                                                }else{
                                                    return  Response::json(array('status'=>'error','type'=>'company name conflict'));   
                                                }
                                             
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
                                            if(($columnstatus==='success')&&($data[$i]['client_name']===$clientdata->client_name)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $error=0;
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    User::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['userslist']);
                                                if($datacheck == 'success'){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    
                                                    $users = User::insertUsers($data[$i],$data2);
                                                    if($error==0){
                                                     $error=0;
                                                    }
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['userslist']);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                        $data2['client_id']=$clientdata->id;
                                                        $data2['upload_id']=$upload_status->id;
                                                        $data[$i]['error']='Data Validation Error on column '.$datacheck.' ]';
                                                        $error=1;
                                                        $errobj_list=Erruserlist::insertusererrlist($data[$i],$data2);
                                                    }
                                                    
                                                }
                                     }else{
                                          if($columnstatus != 'success'){
                                                // Column not found error
                                                     return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                                    
                                          }else{
                                                    return  Response::json(array('status'=>'error','type'=>'company name conflict'));   
                                          }
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
                                            if(($columnstatus==='success')&&($data[$i]['client_name']===$clientdata->client_name)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $error=0;
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Objectiveprogress::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['objectiveextract']);
                                                if($datacheck == 'success' ){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $users = Objectiveprogress::insertobjectiveprogress($data[$i],$data2);
                                                    if($error==0){
                                                    $error=0;
                                                    }
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['objectiveextract']);
                                                    if(!$rowemptycheck){
                                                        // Data Validation Error insert to Error table
                                                        $data2['client_id']=$clientdata->id;
                                                        $data2['upload_id']=$upload_status->id;
                                                        $data[$i]['error']='Data Validation Error on column '.$datacheck;
                                                        $error=1;
                                                        $errobj_list=Errobjectiveprogresslist::inserterrobjectiveprogresslist($data[$i],$data2);
                                                    }
                                                }
                                            }else{
                                                if($columnstatus != 'success'){
                                                    // Column not found error
                                                    return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                                    
                                                }else{
                                                    return  Response::json(array('status'=>'error','type'=>'company name conflict'));   
                                                }
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
                                            if(($columnstatus=='success')&&($data[$i]['client_name']===$clientdata->client_name)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $error=0;
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Badges::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['badgesextract']);
                                                if($datacheck == 'success'){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $badges =  Badges::insertBadges($data[$i],$data2);
                                                    if($error==0){
                                                     $error=0;
                                                    }
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['badgesextract']);
                                                    //return Response::json($rowemptycheck);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $data[$i]['error']='Data Validation Error on column '.$datacheck;
                                                    $error=1;
                                                    $errobj_list=Errbadges::insertbadgeserrlist($data[$i],$data2);
                                                    }
                                                }
                                            }else{
                                                if($columnstatus != 'success'){
                                                      // Column not found error
                                                     return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                                    
                                                }else{
                                                    return  Response::json(array('status'=>'error','type'=>'company name conflict'));   
                                                }
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
                                            if(($columnstatus=='success')&&($data[$i]['client_name']===$clientdata->client_name)){
                                                //Getting the instance of UploadStatus
                                                if($i==0){
                                                    $error=0;
                                                    $upload_status=Uploadstatus::insertuploadstatus($uploadstatusdata);
                                                    Objectiveleaderboard::where('client_id','=',$clientdata->id)->update(['status'=>'N']);
                                                }
                                                // now checking for Data Validations
                                                $datacheck=AdminController::checkfordata($data[$i],$columnnames['leaderboard']);
                                                if($datacheck == 'success'){
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $users =  Objectiveleaderboard::insertleadObjective($data[$i],$data2);
                                                    if($error==0){
                                                    $error=0;
                                                    }
                                                }else{
                                                    $rowemptycheck=  AdminController::rowemtycheck($data[$i],$columnnames['leaderboard']);
                                                    if(!$rowemptycheck){
                                                    // Data Validation Error insert to Error table
                                                    $data2['client_id']=$clientdata->id;
                                                    $data2['upload_id']=$upload_status->id;
                                                    $data[$i]['error']='Data Validation Error on column '.$datacheck;
                                                    $error=1;
                                                    $errobj_list=Errleaderboardlist::insertleaderboarderrlist($data[$i],$data2);
                                                    }
                                                }
                                     }else{
                                            if($columnstatus != 'success'){
                                                      // Column not found error
                                                return  Response::json(array('status'=>'error','type'=>'Column '.$columnstatus.' Missing'));
                                                    
                                            }else{
                                                return  Response::json(array('status'=>'error','type'=>'company name conflict'));   
                                            }
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

    
    
    
    
    public function dumperrorupload($upload_id){
        $upload_data=Uploadstatus::find($upload_id);
        switch($upload_data['insert_table']){
         case 'USER':
                      
                       $data=Erruserlist::where('upload_id','=',$upload_id)->select('name','emp_code','client_name',
                               'mobilenumber','territory','region','designation','user_level_name',
                               'user_level_image_name','user_points','created_ts','status','reporting_user',
                               'reporting_name','reporting_desg','error')->get();
                       $userlistArray[]=['USER_NAME','USER_MOBILE','USER_EMP_CODE','REPORTING_USER',
                                    'REPORTING_NAME','REPORTING_DESG','USER_LEVEL_NAME','USER_LEVEL_IMAGE_NAME',
                                    'USER_POINTS','CREATED_TS','STATUS','REGION','TERRITORY','DESIGNATION',
                                    'CLIENT_NAME','ERROR'];
                                
                       for($i=0;$i<count($data);$i++){
                       if($i==0){
                            $client_data=Clients::find($data[$i]['client_id']);
                        }
                        $userlistArray[]=[$data[$i]['name'],$data[$i]['mobilenumber'],$data[$i]['emp_code'],
                                          $data[$i]['reporting_user'],$data[$i]['reporting_name'],
                                          $data[$i]['reporting_desg'],$data[$i]['user_level_name'],
                                          $data[$i]['user_level_image_name'],$data[$i]['user_points'],
                                          $data[$i]['created_ts'],$data[$i]['status'],$data[$i]['region'],
                                          $data[$i]['territory'],$data[$i]['designation'],
                                          $data[$i]['client_name'],$data[$i]['error']];    
                       }
                       unset($data);
                       Excel::create('USER_DETAILS',function($excel) use($userlistArray){
                            $excel->setTitle('USER_DETAILS');
                            $excel->setCreator('Portal')->setCompany('WORXOGO');
                            $excel->setDescription('User List');

                            $excel->sheet('USER_LIST',function($sheet) use($userlistArray){
                                $sheet->fromArray($userlistArray, null, 'A1', false, false); 
                            }); 
                       })->export('xlsx');
             
                       break;
                    
         case 'OBJECTIVE_LIST': 
                                $data=ErrObjlist::where('upload_id','=',$upload_id)->select('obj_id','objective_name','status','created_ts','client_id','error')->get();
                                $objlistArray[]=['OBJECTIVE_NO','OBJECTIVE_TEXT','STATUS','CREATED_TS','CLIENT_NAME','ERROR'];
                                
                                for($i=0;$i<count($data);$i++){
                                if($i==0){
                                    $client_data=Clients::find($data[$i]['client_id']);
                                }
                                $objlistArray[]=[$data[$i]['obj_id'],$data[$i]['objective_name'],$data[$i]['status'],$data[$i]['created_ts'],$client_data['client_name'],$data[$i]['error']];    
                                }
                                unset($data);
                                Excel::create('OBJECTIVE_LIST',function($excel) use($objlistArray){
                                    $excel->setTitle('OBJECTIVE_LIST');
                                    $excel->setCreator('Portal')->setCompany('WORXOGO');
                                    $excel->setDescription('Objective List');

                                   $excel->sheet('OBJECTIVE_LIST',function($sheet) use($objlistArray){
                                      $sheet->fromArray($objlistArray, null, 'A1', false, false); 
                                   }); 
                                })->export('xlsx');
             
                                  break;
         case 'OBJECTIVES_PROGRESS':
                        $data=Erruserlist::where('upload_id','=',$upload_id)->get();
                       $userlistArray[]=['USER_NAME','USER_MOBILE_NO','USER_EMPLOYEE_CODE','OBJECTIVE_NO',
                                    'OBJECTIVE_TEXT','DATA_TYPE','OBJECTIVE_TYPE','TARGET_OBJ_MONTH',
                                    'TARGET_OBJ_VALUE','TARGET_OBJ_ACH_PER','TARGET_OBJ_ACH_VALUE',
                                    'TARGET_OBJ_TOBE_ACH_PER','TARGET_OBJ_TOBE_ACH_VALUE','TARGET_OBJ_VALUE_UNITS',
                                    'TARGET_OBJ_SKEW_INDICATOR','TARGET_OBJ_SKEW_TARGET','SEG_OBJ_START_VALUE',
                                    'SEG_OBJ_END_VALUE','SEG_OBJ_START_PER','SEG_OBJ_END_PER','SEG_OBJ_VALUE_UNITS',
                                    'SEG_OBJ_GOOD_START_PER','SEG_OBJ_GOOD_END_PER','SEG_OBJ_BAD_START_PER',
                                    'SEG_OBJ_BAD_END_PER','SEG_OBJ_VGOOD_START_PER','SEG_OBJ_VGOOD_END_PER',
                                    'SEG_OBJ_ACH_VALUE','QTY_HIGHEST_ACH_NO','QTY_CURRENT_ACH_NO','QTY_VALUE_UNITS',
                                    'OBJECTIVE_POINTS','CREATED_TS','STATUS','CLIENT_NAME','SEG_OBJ_TARGET_VALUE',
                                    'SEG_OBJ_TARGET_VALUE_UNITS','SEG_OBJ_TXT','ERROR'];
                                
                       for($i=0;$i<count($data);$i++){
                       if($i==0){
                            $client_data=Clients::find($data[$i]['client_id']);
                        }
                        $objprogressArray[]=[$data[$i]['user_name'],$data[$i]['mobile_no'],$data[$i]['emp_code'],$data[$i]['obj_no'],
                                          $data[$i]['obj_text'],$data[$i]['objective_datatype'],$data[$i]['objective_type'],$data[$i]['target_obj_mnth'],
                                          $data[$i]['target_value'],$data[$i]['target_ach_percentage'],$data[$i]['target_ach_val'],
                                          $data[$i]['target_to_be_ach_percentage'],$data[$i]['target_to_be_ach_val'],$data[$i]['target_value_unitr'],
                                          $data[$i]['target_obj_skew_indicator'],$data[$i]['target_obj_skew_target'],$data[$i]['seg_start_value'],
                                          $data[$i]['seg_end_value'],$data[$i]['seg_start_percentage'],$data[$i]['seg_end_percentage'],$data[$i]['seg_value_units'],
                                          $data[$i]['seg_good_start_percentage'],$data[$i]['seg_good_end_percentage'],$data[$i]['seg_bad_start_percentage'],
                                          $data[$i]['seg_bad_end_percentage'],$data[$i]['seg_vgood_start_percentage'],$data[$i]['seg_vgood_end_percentage'],
                                          $data[$i]['seg_obj_achvd_value'],$data[$i]['qty_highest_ach_no'],$data[$i]['qty_current_ach_no'],$data[$i]['qty_value_units'],
                                          $data[$i]['obj_points'],$data[$i]['created_ts'],$data[$i]['status'],$data[$i]['client_name'],$data[$i]['seg_obj_target_value'],
                                          $data[$i]['seg_obj_target_value_units'],$data[$i]['seg_obj_txt'],$data[$i]['error']];    
                       }
                       unset($data);
                       Excel::create('OBJ_PROGRESS',function($excel) use($objprogressArray){
                            $excel->setTitle('OBJ_PROGRESS');
                            $excel->setCreator('Portal')->setCompany('WORXOGO');
                            $excel->setDescription('OBJ_PROGRESS');

                            $excel->sheet('OBJ_PROGRESS',function($sheet) use($objprogressArray){
                                $sheet->fromArray($objprogressArray, null, 'A1', false, false); 
                            }); 
                       })->export('xlsx');
             
                       break;
                    
                       
         case 'BADGES':
                                $data=  Errbadges::where('upload_id','=',$upload_id)->select('user_name','mobile_no','emp_code','badge_name','badge_img_name','created_ts','status','client_id','error')->get();
                                $badgeslistArray[]=['USER_NAME','USER_MOBILE_NO','USER_EMPLOYEE_CODE','USER_BADGE_NAME','USER_BADGE_IMAGE_NAME','CREATED_TS','STATUS','CLIENT_NAME','ERROR'];
                                
                                for($i=0;$i<count($data);$i++){
                                if($i==0){
                                    $client_data=Clients::find($data[$i]['client_id']);
                                }
                                $badgeslistArray[]=[$data[$i]['user_name'],$data[$i]['mobile_no'],$data[$i]['emp_code'],$data[$i]['badge_name'],$data[$i]['badge_img_name'],$data[$i]['created_ts'],$data[$i]['status'],$client_data['client_name'],$data[$i]['error']];    
                                }
                                unset($data);
                                Excel::create('Badges',function($excel) use($badgeslistArray){
                                    $excel->setTitle('Badges');
                                    $excel->setCreator('Portal')->setCompany('WORXOGO');
                                    $excel->setDescription('Badges');

                                   $excel->sheet('Badges',function($sheet) use($badgeslistArray){
                                      $sheet->fromArray($badgeslistArray, null, 'A1', false, false); 
                                   }); 
                                })->export('xlsx');
                                break;
         case 'OBJECTIVE_LEADERBOARD':
                                $data=  Errbadges::where('upload_id','=',$upload_id)->select('user_name','mobile_no','emp_code','badge_name','badge_img_name','created_ts','status','client_id','error')->get();
                                $badgeslistArray[]=['USER_NAME','USER_MOBILE_NO','USER_EMPLOYEE_CODE','USER_BADGE_NAME','USER_BADGE_IMAGE_NAME','CREATED_TS','STATUS','CLIENT_NAME','ERROR'];
                                
                                for($i=0;$i<count($data);$i++){
                                if($i==0){
                                    $client_data=Clients::find($data[$i]['client_id']);
                                }
                                $badgeslistArray[]=[$data[$i]['user_name'],$data[$i]['mobile_no'],$data[$i]['emp_code'],$data[$i]['badge_name'],$data[$i]['badge_img_name'],$data[$i]['created_ts'],$data[$i]['status'],$client_data['client_name'],$data[$i]['error']];    
                                }
                                unset($data);
                                Excel::create('Badges',function($excel) use($badgeslistArray){
                                    $excel->setTitle('Badges');
                                    $excel->setCreator('Portal')->setCompany('WORXOGO');
                                    $excel->setDescription('Badges');

                                   $excel->sheet('Badges',function($sheet) use($badgeslistArray){
                                      $sheet->fromArray($badgeslistArray, null, 'A1', false, false); 
                                   }); 
                                })->export('xlsx');
                        break;
         
         default:
                    break;
         
            
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
