<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Objective extends Model
{
        protected $fillable = array('client_id','objectivename','status','created_ts');
        protected $table = 'obj_list';
        
        
        public function objectiveprogress(){
	
		return $this->hasMany('App\Objectiveprogress', 'obj_list_id');
	}
        
        public function client(){
            return $this->belongsTo('App\Clients', 'client_id');
        }
    
        static public function getlist($client_id){
            return Objective::with('client')->where('client_id','=',$client_id)->get();
        }
    
    
        static public function insertObjective($data,$data2){
            
            
            $newobjective= Objective::firstOrNew(['client_id'=>$data2['client_id'],'objective_name'=>$data['objective_text']]);
            $newobjective->client_id=$data2['client_id'];
            $newobjective->upload_id=$data2['upload_id'];
            $newobjective->obj_id=$data['objective_no'];
            $newobjective->objective_name=$data['objective_text'];
            $newobjective->status=$data['status'];
            $newobjective->created_ts=$data['created_ts'];
            $newobjective->created_by=Session::get('userId');
            $newobjective->save();
            return $newobjective;
            
        }
    //
}
