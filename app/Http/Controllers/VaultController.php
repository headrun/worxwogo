<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Clients;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class vaultController extends Controller
{
    public function login(Request $request){
        $inputs = $request->all();
        if(isset($inputs['mobileNumber']) && isset($inputs['client_id']) && User::where('mobilenumber','=',$inputs['mobileNumber'])->where('user_type','=','USER')->where('client_id','=',$inputs['client_id'])->where('status','=','A')->exists()){
            $user_data=User::where('mobilenumber','=',$inputs['mobileNumber'])->where('user_type','=','USER')->where('client_id','=',$inputs['client_id'])->where('status','=','A')->get();
            $user_data=$user_data[0];
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
            $client_data=Clients::find($inputs['client_id']);
            //return $client_data['client_name'];
             return vaultController::register($client_data['client_name']);
           // $viewData = array('client_data');
           // return view('/vault/Register',compact($viewData));/*,compact($viewData)*/
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
	Session::flash('alert-class', 'alert-success');
        if($user_type=='ADMIN'){
            return Redirect::action('VaultController@adminLogin');   
        }else if($user_type=='USER'){
            $destination='/'.$client_data['client_name'];
            return Redirect::to($destination);
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
