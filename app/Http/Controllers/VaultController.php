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
    public function login($clientName){
        if(Clients::where('client_name','=',$clientName)->where('status','=','A')->exists()){
            
        }
    }
    
    public function register(Request $request){
        $inputs = $request->all();
        
            if(Session::get('mobileNumber') && (Session::get('userType')=='USER') ){
                return Redirect::action('DashboardController@index');
                
            }else{
                if (isset($inputs['mobileNumber']) && User::where('mobilenumber','=',$inputs['mobileNumber'])->where('user_type','=','USER')->where('status','=','A')->exists()){//Auth::attempt(array('mobilenumber' => $inputs['mobileNumber']))
                    $user_data=User::where('mobilenumber','=',$inputs['mobileNumber'])->where('user_type','=','USER')->where('status','=','A')->get();
                    $user_data=$user_data[0];
                    Auth::loginUsingId($user_data['id']);
                    Session::put('userId', $user_data->id);
                    Session::put('clientId', $user_data->client_id);
                    Session::put('name', $user_data->name);
                    Session::put('points', $user_data->user_points);
                    Session::put('mobileNumber', $user_data->mobilenumber);
                    Session::put('userType', $user_data->user_type);
                    Session::put('region', $user_data->region);
                    Session::put('territory', $user_data->territory);
                    return redirect()->intended('/dashboard/index');
               
            }else{
               // $viewData = array('clientName');
                return view('/vault/Register');/*,compact($viewData)*/
            }
        
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
        Session::flush();
	Session::flash('message', 'You have successfully logged out of the system.');
	Session::flash('alert-class', 'alert-success');
        if($user_type=='ADMIN'){
            return Redirect::action('VaultController@adminLogin');   
        }else if($user_type=='USER'){
            return Redirect::action('VaultController@register');
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
