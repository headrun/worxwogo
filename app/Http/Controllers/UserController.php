<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use Excel;
use Input;
use DB;
use App\User;
use App\Uploadstatus;

class UserController extends Controller
{
    
    
    
    public function addUsers(){
        if(Auth::check() && (Session::get('userType')=='ADMIN')){
            
            $users_data=User::where('client_id','=',Session::get('clientId'))->where('status','=','A')->get();
            $dataToView = array('users_data');
            return view('admindashboard/addusers',compact($dataToView));
        }else{
            return Redirect::action('VaultController@logout');
        }
    } 
    
    
//    public function uploadUsers(){
//        if(Auth::check() && (Session::get('userType')=='ADMIN')){
//            $data=Excel::load( Input::file('user'), function($reader) {
//            })->get();
//            if(!empty($data) && $data->count()){
//                foreach ($data as $rows) {
//                    foreach($rows as $row){
//                        //checking for all the fields
//                        
//                            $insert[] = ['name'=>$row->name ,'mobilenumber' => $row->mobilenumber];
//                                          
//                    }
//                 }
//                if(!empty($insert)){
//                    
//                    //insert into upload_status table
//                    $data['insert_table']='USER';
//                    $upload_status_id=Uploadstatus::insertuploadstatus($data);
//                    
//                    $z=0;
//                    for($i=0;$i<count($insert);$i++){
//                        
//                        if(strlen($insert[$i]['mobilenumber'])=='10' && strlen($insert[$i]['name'])!='0'){
//                            $userData['mobilenumber']=$insert[$i]['mobilenumber'];
//                            $userData['name']=$insert[$i]['name'];
//                            $userData['upload_id']=$upload_status_id->id;
//                            $user_id=User::insertUser($userData);
//                            
//                        }else{
//                            $failure[$z]['status']='failure';
//                            $failure[$z]['mobilenumber']=$insert[$i]['mobilenumber'];
//                            $failure[$z]['name']=$insert[$i]['name'];
//                            $z++;
//                        }
//                    }
//                    
//                }
//            }
//            if(isset($failure)){
//                
//                $dataToView = array('failure');
//                return View::make('status/failure', compact($dataToView));
//                
//            }else{
//                return Redirect::action('UserController@success');
//                
//            }
//            
//        }
//    }
    
//    public function success(){
//        return view('status/success');
//    }
//    public function failure(){
//        return view('status/failure');
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
