<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Clients;
use Hash;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class vaultController extends Controller
{
    public function login(Request $request){
        $inputs = $request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['client_id']) && 
                User::where('mobilenumber','=',$inputs['mobileNumber'])
                      ->where('user_type','=','USER')
                      ->where('client_id','=',$inputs['client_id'])
                      ->where('status','=','A')
                      ->exists()){
            
            $user_data=User::where('mobilenumber','=',$inputs['mobileNumber'])
                    ->where('user_type','=','USER')
                    ->where('client_id','=',$inputs['client_id'])
                    ->where('status','=','A')
                    ->get();
            $user_data=$user_data[0];
            if(Hash::check($inputs['password'],$user_data['password'])){
                Auth::loginUsingId($user_data['id']);
                Session::put('userId', $user_data->id);
                Session::put('clientId', $user_data->client_id);
                Session::put('empId', $user_data->emp_code);
                Session::put('name', $user_data->name);
                Session::put('points', $user_data->user_points);
                Session::put('mobileNumber', $user_data->mobilenumber);
                Session::put('userType', $user_data->user_type);
                Session::put('region', $user_data->region);
                Session::put('territory', $user_data->territory);
                return redirect()->intended('/dashboard/index');
            }else{
                Session::flash('message', 'Invalid Mobile No or Password.');
                $client_data=Clients::find($inputs['client_id']);
                return Redirect::to ('/'.$client_data['client_name']);
            }
        }else{
            $client_data=Clients::find($inputs['client_id']);
            Session::flash('message', 'Invalid Mobile No or Password.');
            return Redirect::to ('/'.$client_data['client_name']);
        }
    }
    
    public function register($company_name){
        
            if(Session::get('mobileNumber') && (Session::get('userType')=='USER') ){
                return Redirect::action('DashboardController@index');
                
            }else{
                if(Clients::where('client_name','=',$company_name)->exists()){
                    $client_data=  Clients::where('client_name','=',$company_name)->get();
                    $client_data=$client_data[0];
                    $viewData = array('client_data');
                    return view('/vault/Register',compact($viewData));/*,compact($viewData)*/

                }else{
                    //show company not found
                    return "Company not Registered";
                }
        
        }
     
    }
    
    public function def(){
        if(Session::get('mobileNumber') && (Session::get('userType')=='USER') ){
                return Redirect::action('DashboardController@index');
                
            }else{
                  return "Please use xg/companyname";
            }
    }
    
    public function adminLogin(Request $request){
        $inputs = $request->all();
        if(Session::get('email') && (Session::get('userType')=='ADMIN')){
            return Redirect::action('DashboardController@addcompany');
        }else{
            if ( isset($inputs['email']) &&  isset($inputs['password']) && Auth::attempt(array('email' => $inputs['email'], 'password' => $inputs['password']))){
                $user_data=User::find(Auth::id());
                Session::put('userId', $user_data->id);
                Session::put('userName', $user_data->name);
                Session::put('email', $user_data->email);
                Session::put('clientId', $user_data->client_id);
                Session::put('userType', $user_data->user_type);
                 return redirect()->intended('/admindashboard/addcompany');
              // return view('/dashboard/index');
            }else{
                
                return view('/vault/adminlogin');
            }
        }
    }
    
    
    public function logout(){
        $user_type=Session::get('userType');
        $client_data=Clients::find(Session::get('clientId'));
        Session::flush();
	Session::flash('message', 'You have successfully logged out of the system.');
	if($user_type=='ADMIN'){
            return Redirect::action('VaultController@adminLogin');   
        }else if($user_type=='USER'){
            $destination='/'.$client_data['client_name'];
            return Redirect::to($destination);
        }
        
    }
    
    public function checkMobileNoforRegistration(Request $request){
        $inputs=$request->all();
        if(isset($inputs['mobileNumber']) &&
           User::where('client_id','=',$inputs['client_id'])
                ->where('mobilenumber','=',$inputs['mobileNumber'])
                ->where('password','=','')
                ->where('status','=','A')
                ->exists()  ){
            $user_data=User::where('client_id','=',$inputs['client_id'])
                            ->where('mobilenumber','=',$inputs['mobileNumber'])
                            ->where('password','=','')
                            ->where('status','=','A')
                            ->select('id')->get();
            $user_data=$user_data[0];
            $user=User::find($user_data['id']);
            $string = str_random(6);
            
            $msg="Dear User, you are trying to Register your A/c. Your OTP is ".$string." DONT SHARE WITH ANYONE";
             //file_get_contents("http://smshorizon.co.in/api/sendsms.php?user=LM-WRX&apikey=tVzFTcAxyXiWhh3Rs7wb&mobile=".(int)$inputs['mobileNumber']."&message=".$msg."&senderid=WRXOGO&type=txt",false);
            $msg=urlencode($msg);
            $ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=LM-WRX&apikey=tVzFTcAxyXiWhh3Rs7wb&mobile=".$inputs['mobileNumber']."&senderid=WRXOGO&message=".$msg."&type=txt"); 
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);      
            curl_close($ch);
            
            $user->otp=$string;
            $user->save();
            
            return Response::json(array('status'=>'success'));
            
        }else{
            return Response::json(array('status'=>'failure'));
        }
        
    }
    
    
    public function checkOTPforRegistration(Request $request ){
        $inputs=$request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['otppassword']) &&
           User::where('client_id','=',$inputs['client_id'])
                ->where('mobilenumber','=',$inputs['mobileNumber'])
                ->where('otp','=',$inputs['otppassword'])
                ->where('status','=','A')
                ->exists()  ){
            
            return Response::json(array('status'=>'success'));
            
         }else{
             return Response::json(array('status'=>'failure'));
         }
        
    }
    
    public function registeruser(Request $request){
        $inputs=$request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['otppassword']) &&
           isset($inputs['password']) && isset($inputs['confirmpassword']) &&
           ($inputs['password']==$inputs['confirmpassword']) &&
           User::where('client_id','=',$inputs['client_id'])
                ->where('mobilenumber','=',$inputs['mobileNumber'])
                ->where('otp','=',$inputs['otppassword'])
                ->where('password','=','')
                ->where('status','=','A')
                ->exists()  ){
            
            $user_data=User::where('client_id','=',$inputs['client_id'])
                             ->where('mobilenumber','=',$inputs['mobileNumber'])
                             ->where('otp','=',$inputs['otppassword'])
                             ->where('password','=','')
                             ->where('status','=','A')
                             ->select('id')->get();
            $user_data=$user_data[0];
            $user=User::find($user_data['id']);
            $user->password=Hash::make($inputs['password']);
            $user->save();
            
            return Response::json(array('status'=>'success'));
            
         }else{
             return Response::json(array('status'=>'failure'));
         }
    }

    public function UpdatePassword(Request $request) {
        $inputs=$request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['password']) && isset($inputs['confirmpassword']) &&
           User::where('client_id','=',$inputs['client_id'])
                ->where('mobilenumber','=',$inputs['mobileNumber'])
                ->where('password','!=','')
                ->where('status','=','A')
                ->exists()
          ){
            $user_data=User::where('client_id','=',$inputs['client_id'])
                             ->where('mobilenumber','=',$inputs['mobileNumber'])
                             ->where('password','!=','')
                             ->where('status','=','A')
                             ->select('id')->get();
            $user_data=$user_data[0];
            $user=User::find($user_data['id']);
            $user->password=Hash::make($inputs['password']);
            $user->save();
            
             return Response::json(array('status'=>'success'));
        }else{
            return Response::json(array('status'=>'failure'));
        }
    }
    
    
    public function checkMobileNumberValidForChangePassword(Request $request){
        $inputs=$request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['client_id']) &&
           User::where('client_id','=',$inputs['client_id'])
                ->where('mobilenumber','=',$inputs['mobileNumber'])
                ->where('password','!=','')
                ->where('status','=','A')
                ->exists()  ){
            
            // set OTP
            $user_data=User::where('client_id','=',$inputs['client_id'])
                            ->where('mobilenumber','=',$inputs['mobileNumber'])
                            ->where('password','!=','')
                            ->where('status','=','A')->get();
            $user_data=$user_data[0];
            $user=User::find($user_data['id']);
            
            $string = str_random(6);
            $msg="Dear User, you are trying to Change Password for  your A/c. Your OTP is ".$string." DONT SHARE WITH ANYONE";
            $msg=urlencode($msg);
            
            $ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=LM-WRX&apikey=tVzFTcAxyXiWhh3Rs7wb&mobile=".$inputs['mobileNumber']."&senderid=WRXOGO&message=".$msg."&type=txt"); 
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);      
            curl_close($ch);
             
            $user->otp=$string;
            $user->save();
            
            
            
            return Response::json(array('status'=>'success'));
        }else{
            return Response::json(array('status'=>'failure'));
        }
        
    }
    
    public function otppasswordcheckforforgotpassword(Request $request){
        $inputs=$request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['client_id']) && isset($inputs['otppassword']) &&
           User::where('client_id','=',$inputs['client_id'])
                ->where('mobilenumber','=',$inputs['mobileNumber'])
                ->where('password','!=','')
                ->where('otp','=',$inputs['otppassword'])
                ->where('status','=','A')
                ->exists()  ){
            
            return Response::json(array('status'=>'success'));
        }else{
            return Response::json(array('status'=>'failure'));
        }
    }
    
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
