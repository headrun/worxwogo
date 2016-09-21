<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

class Objectiveleaderboard extends Model
{
     protected $table = 'obj_leaderboard';
     protected $fillable = array('client_id','mobile_no');
     
     public function User(){
         return $this->belongsTo('App\User', 'user_id');
     }
     
     static public function getobjleaddata(){
         return Objectiveleaderboard::
                                      where('client_id','=',Session::get('clientId'))
                                      ->where('region','=',Session::get('region'))
                                      ->where('status','=','A')
                                      ->orderBy('rank')
                                      ->get();
     }
     
     static public function insertleadObjective($data,$data2){
         $newobjectivelead= new Objectiveleaderboard();
         $newobjectivelead->obj2_list_id=$data['objective_no'];
         $newobjectivelead->upload_id=$data2['upload_id'];
         $newobjectivelead->client_id=$data2['client_id'];
         $newobjectivelead->user_name=$data['user_name'];
         $newobjectivelead->mobile_no=$data['user_mobile_no'];
         $newobjectivelead->obj_text=$data['objective_text'];
         $newobjectivelead->emp_code=$data['user_employee_code'];
         $newobjectivelead->rank=$data['user_rank'];
         $newobjectivelead->points=$data['user_points'];
         $newobjectivelead->status=$data['status'];
         $newobjectivelead->region=$data['region'];
         $newobjectivelead->territory=$data['territory'];
         $newobjectivelead->client_name=$data['client_name'];
         $newobjectivelead->created_ts=$data['created_ts'];
         $newobjectivelead->created_by=Session::get('userId');
         $newobjectivelead->save();
         return $newobjectivelead;
            
     }
}
