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
use App\Msg;
use DB;
use Response;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use File;

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
            /*
            $objective_data=Objectiveprogress::getobjectivedata();
            
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
             * 
             */
            //$user=User::find(Session::get('userId'));
            $client_data=Clients::find(Session::get('clientId'));
            $dataToView = array('client_data');
            return view('/dashboard/index',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function ajaxtest(){
        $client_data=Clients::find(44);
        header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
    header('Access-Control-Allow-Credentials: true');
        return Response::json(array('status'=>'success','data'=>$client_data));
    }
    
    
    public function getindexdata(Request $request){
        if(Auth::check()){
            $inputs = $request->all();
            $objective_data=Objectiveprogress::getobjectivedata();
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
            $badges_data= Badges::where('mobile_no','=',Session::get('mobileNumber'))
                                  ->where('client_id','=',Session::get('clientId'))
                                  ->where('status','=','A')
                                  ->get();
            $user=User::find(Session::get('userId'));
            $client_data=Clients::find(Session::get('clientId'));
            $objleaderboarddata=Objectiveleaderboard::getobjleaddata();
            for($i=0;$i<count($objleaderboarddata);$i++){
                
                $objleaderboarddata[$i]['user']=User::where('mobilenumber','=',$objleaderboarddata[$i]['mobile_no'])->where('status','=','A')->get();
              
            }
            
            return Response::json(array('status'=>'success',
                                       'obj_data'=>$objective_data,
                                       'client_last_updated'=>date('d-m-Y',strtotime($client_last_updated['created_at'])),
                                       'user_data'=>$user,
                                       'badges_data'=>$badges_data,
                                       'leaderboard_data'=>$objleaderboarddata,
                                        'client_data'=>$client_data));
        }else{
            return Response::json(array('status'=>'failure'));
        }
    }


    public function addcompany(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            $currentPage  =  "";
            $mainMenu     =  "ADDCOMPANY";
            
            $clients_data=Clients::all();
            /* SELECT DISTINCT (`client_id`) as `s`, (SELECT COUNT(`s`) FROM `users` WHERE `client_id`= `s`) as `count` FROM `users` */
            
            for($i=0;$i<count($clients_data);$i++){
                $clients_data[$i]['totalusers']= User::where('client_id','=',$clients_data[$i]['id'])->where('status','=','A')->count();
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
            $data['program_name']=$inputs['program_name'];
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
            $file=Input::file('edituploadextract');
                
            $clientdata=Clients::find($inputs['company_id']);
            if($file){
                if(File::exists('assets/img/logo/'.$clientdata['id'].$clientdata['client_logo_ext'])){
                    File::delete('assets/img/logo/'.$clientdata['id'].$clientdata['client_logo_ext']);
                }
                $file=Input::file('edituploadextract');
                $fileExtension = '.'.$file->getClientOriginalExtension();
                $filename = $inputs['company_id'].$fileExtension;
                $result = Input::file('edituploadextract')->move('assets/img/logo/', $filename);
                $clientdata->client_logo_ext=$fileExtension;
            }
            
            $clientdata->client_name=$inputs['company_name'];
            $clientdata->program_name=$inputs['program_name'];
            $clientdata->status=$inputs['status'];
            $clientdata->save();
            return Response::json(array('status'=>'success'));
        }
    }
    
    
    
    public function profile(){
        if(Auth::check()){
             $client_data=Clients::find(Session::get('clientId'));
            $dataToView = array('client_data');
            return view('/dashboard/profile',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function getprofiledata(){
        if(Auth::check()){
            $userdata=User::find(Session::get('userId'));
            $user=$userdata;
            $badges_data= Badges::where('mobile_no','=',Session::get('mobileNumber'))
                                  ->where('client_id','=',Session::get('clientId'))
                                  ->where('status','=','A')
                                  ->get();
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
             $client_data=Clients::find(Session::get('clientId'));
            
             return Response::json(array('status'=>'success','user_data'=>$userdata,
                                        'badges_data'=>$badges_data,'client_last_updated'=>date('d-m-Y',strtotime($client_last_updated['created_at'])),
                                        'client_data'=>$client_data));
             
        }else{
            return Response::json(array('status'=>'failure'));
        }
    }
    
    public function leaderboard(){
        if(Auth::check()){
            $client_data=Clients::find(Session::get('clientId'));
            $dataToView = array('objleaderboarddata','client_last_updated','user','client_data');
            return View ('/dashboard/leaderboard',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    }
    
    public function getleaderboarddata(){
        if(Auth::check()){
            $objleaderboarddata=Objectiveleaderboard::getobjleaddata();
            for($i=0;$i<count($objleaderboarddata);$i++){
                
                $objleaderboarddata[$i]['user']=User::where('mobilenumber','=',$objleaderboarddata[$i]['mobile_no'])->where('status','=','A')->get();
              
            }
            $client_last_updated=  Uploadstatus::where('client_id','=',Session::get('clientId'))
                                                ->orderBy('id','desc')
                                                ->select('created_at')
                                                ->first();
    
            $user=User::find(Session::get('userId'));
            $client_data=Clients::find(Session::get('clientId'));
           
            return Response::json(array('status'=>'success','client_last_updated'=>date('d-m-Y',strtotime($client_last_updated['created_at'])),
                                        'leaderboard_data'=>$objleaderboarddata,'user_data'=>$user,
                                        'client_data'=>$client_data));
            
        }else{
             return Response::json(array('status'=>'failure'));
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
            $objlist=Objective::where('client_id','=',$inputs['company_id'])->where('status','=','A')->get();
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
    


    public function getSupervisorDashboardData() {
        if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        $dashboard_data=[];
        
        $emp_list_of_supervisor=DB::select(DB::raw("select DISTINCT(emp_code) from users where reporting_user = '".Session::get('empId')."'AND client_id='".Session::get('clientId')."' AND status ='A'"));

        
        foreach($emp_list_of_supervisor as $emp){
          $sup_emp_list[]=$emp->emp_code;
        }
        unset($emp_list_of_supervisor);

        $objectiveslist=Objective::where('client_id','=',Session::get('clientId'))
                                  ->where('status','=','A')
                                  ->select('obj_id','objective_name')
                                  ->get();
        
        foreach($objectiveslist as $objective){

          $o=Objectiveprogress::where('client_id','=',Session::get('clientId'))
                            ->whereIn('emp_code',$sup_emp_list)
                            ->where('obj_no','=',$objective['obj_id'])
                            ->where('status','=','A')
                            //->select('obj_no','seg_obj_achvd_value','target_ach_percentage','objective_type')
                            ->get();
          for($i=0;$i<count($o);$i++) {
            $objective['objective_type']=$o[$i]['objective_type'];
            if($o[$i]['objective_type']=='RANGE'){
              if($i==0){
                $objective['seg_bad_percentage']=0;
                $objective['seg_good_percentage']=0;
                $objective['seg_vgood_percentage']=0;
              }
              $objective['seg_bad_start_percentage']=$o[$i]['seg_bad_start_percentage'];
              $objective['seg_bad_end_percentage']=$o[$i]['seg_bad_end_percentage'];
              $objective['seg_good_start_percentage']=$o[$i]['seg_good_start_percentage'];
              $objective['seg_good_end_percentage']=$o[$i]['seg_good_end_percentage'];
              $objective['seg_vgood_start_percentage']=$o[$i]['seg_vgood_start_percentage'];
              $objective['seg_vgood_end_percentage']=$o[$i]['seg_vgood_end_percentage'];

              if(($o[$i]['seg_obj_achvd_value'] >= $o[$i]['seg_bad_start_percentage'])&&($o[$i]['seg_obj_achvd_value'] <= $o[$i]['seg_bad_end_percentage'])){

                $objective['seg_bad_percentage']=$objective['seg_bad_percentage']+1;

              }elseif(($o[$i]['seg_obj_achvd_value'] >= $o[$i]['seg_good_start_percentage'])&&($o[$i]['seg_obj_achvd_value'] <= $o[$i]['seg_good_end_percentage'])){

                $objective['seg_good_percentage']=$objective['seg_good_percentage']+1;
              
              }elseif(($o[$i]['seg_obj_achvd_value'] >= $o[$i]['seg_vgood_start_percentage'])){

                $objective['seg_good_percentage']=$objective['seg_good_percentage']+1;
              
              }  
                
            }

            if(($o[$i]['seg_obj_achvd_value']!=0) || ($o[$i]['target_ach_percentage']!=0)){
              if($i==0){
                $percent['0to25percentage']=0;
                $percent['26to50percentage']=0;
                $percent['51to75percentage']=0;
                $percent['76to100percentage']=0;
                $percent['morethan100percentage']=0;

              }

              if(($o[$i]['seg_obj_achvd_value']!=0)){
                $calpercent=  $o[$i]['seg_obj_achvd_value'];
              }else{
                $calpercent=  $o[$i]['target_ach_percentage'];
              }
              
              if(($calpercent >0) && ($calpercent <=25)){
                  
                $percent['0to25percentage']=$percent['0to25percentage']+1;

              }elseif(($calpercent >25) && ($calpercent <=50)){
                $percent['26to50percentage']=$percent['26to50percentage']+1;
              }elseif(($calpercent >50) && ($calpercent <=75)){
                $percent['51to75percentage']=$percent['51to75percentage']+1;
              }else if(($calpercent >75) && ($calpercent <=100)){
                $percent['76to100percentage']=$percent['76to100percentage']+1;
              }else{
                $percent['morethan100percentage']=$percent['morethan100percentage']+1;
              }

              

            }else{
                $percent['0to25percentage']=0;
                $percent['26to50percentage']=0;
                $percent['51to75percentage']=0;
                $percent['76to100percentage']=0;
                $percent['morethan100percentage']=0;
            }

          }

          $objective['percent']=$percent;
          
          $objective['obj_points']=Objectiveprogress::where('client_id','=',Session::get('clientId'))
                            ->whereIn('emp_code',$sup_emp_list)
                            ->where('obj_no','=',$objective['obj_id'])
                            ->where('status','=','A')
                            ->sum('obj_points');
        }

        return Response::json(array('status'=>'success','data'=>$objectiveslist));       

      }
      return Response::json(array('status'=>'failure'));
    
    }


    public function getSoDataForSupervisor(){
      
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        
        $inputs=Input::all();
        $objective_data=Objectiveprogress::getobjectivedataforso($inputs['so_id']);
        
        return Response::json(array('status'=>'success','data'=>$objective_data));        
      
      }
      
        return Response::json(array('status'=>'failure'));
      
    }


    public function getSupervisorLeaderboardData(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        $inputs=Input::all();

        /*
        $emp_list_of_supervisor=DB::select(DB::raw("select DISTINCT(emp_code), name, user_points,mobilenumber from users where reporting_user = '".Session::get('empId')."'AND client_id='".Session::get('clientId')."' AND status ='A'"));
        */


        if($inputs['send_data_type']=='YTD'){
          if($inputs['obj_id']!=='All'){
          $senddata;
          $p=0;
          $empdata=DB::select(DB::raw("select users.emp_code as emp_id,users.mobilenumber as emp_mobile_number, users.name as emp_name, obj_progress.obj_points as emp_points from users  inner join obj_progress on users.emp_code = obj_progress.emp_code where users.emp_code in  (select DISTINCT(emp_code) from users where reporting_user = '".Session::get('empId')."'AND client_id='".Session::get('clientId')."' AND status ='A') AND obj_progress.obj_no = '".$inputs['obj_id']."' AND obj_progress.status='A'AND users.status='A' order by obj_points DESC"));
        //return Response::json(array('status'=>'success','data'=>$senddata));          
        
          foreach($empdata as $emp){
          
            $senddata[$p]['emp_id']=$emp->emp_id;
            $senddata[$p]['emp_name']=$emp->emp_name;
            $senddata[$p]['emp_mobile_number']=$emp->emp_mobile_number;
            
            $monthsyr=DB::select(DB::raw("SELECT DISTINCT (MONTH(created_at)) as 'month_no', YEAR(created_at) as 'year'  from obj_progress where emp_code='".$emp->emp_id."' order by Year(created_at),month(created_at)"));
              for($j=0;$j<count($monthsyr);$j++){
                if($j==0){
                  $z=0;
                }
               $myr[$z]['month_no']=$monthsyr[$j]->month_no;
               $myr[$z]['year']=$monthsyr[$j]->year;
               $z++;
              }

          
          
          $senddata[$p]['monthwise_data']=$myr;

                  
          
          for($i=0;$i<count($senddata[$p]['monthwise_data']);$i++){


          
            $test=DB::select(DB::raw("SELECT obj_points from obj_progress where DATE(created_at) =(SELECT MAX( DATE(created_at)) from obj_progress where MONTH(created_at)='".$senddata[$p]['monthwise_data'][$i]['month_no']."' AND YEAR(created_at)='".$senddata[$p]['monthwise_data'][$i]['year']."') AND obj_no ='".$inputs['obj_id']."' AND emp_code = '".$senddata[$p]['emp_id']."'"));

              $senddata[$p]['monthwise_data'][$i]['points']=$test[0]->obj_points;  
          
          }
          if(count($test>0)){
            $senddata[$p]['emp_points']=$test[count($test)-1]->obj_points;
            
          }
            $p++; 
          
        }
        return Response::json(array('status'=>'success','data'=>$senddata));
        }else if($inputs['obj_id']=='All'){
          $senddata;
          $p=0;
          $empdata=DB::select(DB::raw("select users.emp_code as emp_id,users.mobilenumber as emp_mobile_number, users.name as emp_name, sum(obj_progress.obj_points) as emp_points from users  inner join obj_progress on users.emp_code = obj_progress.emp_code where users.emp_code in (select DISTINCT(emp_code) from users where reporting_user = '".Session::get('empId')."'AND client_id='".Session::get('clientId')."' AND status ='A')  AND obj_progress.obj_no IN  (SELECT  obj_id from obj_list where client_id = '".Session::get('clientId')."' AND status='A') AND obj_progress.status='A' AND users.status='A' group by emp_id  order by emp_points DESC"));
           foreach($empdata as $emp){
          
            $senddata[$p]['emp_id']=$emp->emp_id;
            $senddata[$p]['emp_name']=$emp->emp_name;
            $senddata[$p]['emp_mobile_number']=$emp->emp_mobile_number;
            
            $monthsyr=DB::select(DB::raw("SELECT DISTINCT (MONTH(created_at)) as 'month_no', YEAR(created_at) as 'year'  from obj_progress where emp_code='".$emp->emp_id."' order by Year(created_at),month(created_at)"));
              
              for($j=0;$j<count($monthsyr);$j++){
                if($j==0){
                  $z=0;
                }
               $myr[$z]['month_no']=$monthsyr[$j]->month_no;
               $myr[$z]['year']=$monthsyr[$j]->year;
               $z++;
              }

          
          
          $senddata[$p]['monthwise_data']=$myr;

                  
          
          for($i=0;$i<count($senddata[$p]['monthwise_data']);$i++){


          
            $test=DB::select(DB::raw("SELECT sum(obj_points) as obj_points from obj_progress where DATE(created_at) =(SELECT MAX( DATE(created_at)) from obj_progress where MONTH(created_at)='".$senddata[$p]['monthwise_data'][$i]['month_no']."' AND YEAR(created_at)='".$senddata[$p]['monthwise_data'][$i]['year']."') AND obj_no IN (SELECT  obj_id from obj_list where client_id = '".Session::get('clientId')."' AND status='A') AND emp_code = '".$senddata[$p]['emp_id']."'"));

            $senddata[$p]['monthwise_data'][$i]['points']=$test[0]->obj_points;  
          
          }
          if(count($test>0)){
            $senddata[$p]['emp_points']=$test[count($test)-1]->obj_points;
          }
            $p++; 
          
        }


          return Response::json(array('status'=>'success','data'=>$senddata)); 
        }
      }elseif($inputs['send_data_type']=='MTD'){
      
        if($inputs['obj_id']!=='All'){        
        $senddata=DB::select(DB::raw("select users.emp_code as emp_id,users.mobilenumber as emp_mobile_number, users.name as emp_name, obj_progress.obj_points as emp_points from users  inner join obj_progress on users.emp_code = obj_progress.emp_code where users.emp_code in  (select DISTINCT(emp_code) from users where reporting_user = '".Session::get('empId')."'AND client_id='".Session::get('clientId')."' AND status ='A') AND obj_progress.obj_no = '".$inputs['obj_id']."' AND obj_progress.status='A'AND users.status='A' order by obj_points DESC"));

      
        return Response::json(array('status'=>'success','data'=>$senddata));
        
        }else if($inputs['obj_id']=='All'){

          $senddata= DB::select(DB::raw("select users.emp_code as emp_id,users.mobilenumber as emp_mobile_number, users.name as emp_name, sum(obj_progress.obj_points) as emp_points from users  inner join obj_progress on users.emp_code = obj_progress.emp_code where users.emp_code in (select DISTINCT(emp_code) from users where reporting_user = '".Session::get('empId')."'AND client_id='".Session::get('clientId')."' AND status ='A')  AND obj_progress.obj_no IN  (SELECT  obj_id from obj_list where client_id = '".Session::get('clientId')."' AND status='A') AND obj_progress.status='A' AND users.status='A' group by emp_id  order by emp_points DESC"));

          
          return Response::json(array('status'=>'success','data'=>$senddata));
        }
      
      }

    }else{
        return Response::json(array('status'=>'failure'));
    }

    }


    public function supleaderboard($obj_id){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){

      $objectiveslist=Objective::where('client_id','=',Session::get('clientId'))
                                  ->where('status','=','A')
                                  ->select('obj_id','objective_name')
                                  ->get();
        
      $dataToView = array('obj_id','objectiveslist');

      return view('dashboard/supervisor/supervisorleaderboard',compact($dataToView));
      
      }else{
        return Redirect::action('VaultController@logout');
      }
    }

    public function supleaderboardwithoutid(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
      $objectiveslist=Objective::where('client_id','=',Session::get('clientId'))
                                  ->where('status','=','A')
                                  ->select('obj_id','objective_name')
                                  ->get();
      if(count($objectiveslist) >0){
        $obj_id=$objectiveslist[0]['obj_id'];
      }
      
      $dataToView = array('obj_id','objectiveslist');

      return view('dashboard/supervisor/supervisorleaderboard',compact($dataToView));
      }else{
        return Redirect::action('VaultController@logout');
      }
    }

    public function supleaderboardso($so_empid){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        $user_data=User::where('emp_code','=',$so_empid)
                          ->where('status','=','A')
                          ->get();
        $user_data=$user_data[0];
        
        $dataToView = array('user_data');
        return view('dashboard/supervisor/supleaderboardso',compact($dataToView));
      }
      return Redirect::action('VaultController@logout');
    }


    public function supprofile(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        $user_data=User::where('emp_code','=',Session::get('empId'))
                         ->where('status','=','A')
                         ->get();
        $user_data=$user_data[0];      
        $dataToView = array('user_data');           
        return view('dashboard/supervisor/supervisorprofile',compact($dataToView));
      }else{
          return Redirect::action('VaultController@logout');
      }
    }


    public function sendmsg(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        $emp_list=User::where('client_id','=',Session::get('clientId'))
                        ->where('reporting_user',Session::get('empId'))
                        ->where('status','=','A')
                        ->get();
        $dataToView = array('emp_list');                  
        return view('dashboard/supervisor/supervisorsendmsg',compact($dataToView));    
      }else{
        return Redirect::action('VaultController@logout');
      }
    }

    public function sendtextmsg(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        $inputs=Input::all();

        $new_msg=Msg::addMsg($inputs);

        if($new_msg){
          return Response::json(array('status'=>'success','data'=>$inputs));
        }
      }
        return Response::json(array('status'=>'failure'));   
      
    }

    public function sendlike(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        return view('dashboard/supervisor/supervisorsendlike');    
      }else{
        return Redirect::action('VaultController@logout');
      }
    }

    public function supervisorindex(){
      if(Auth::check() && (Session::get('userType')=='SUPERVISOR')){
        return view('dashboard/supervisor/index');    
      }else{
        return Redirect::action('VaultController@logout');
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
