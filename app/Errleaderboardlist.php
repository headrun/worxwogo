<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Errleaderboardlist extends Model
{
    //
    protected $table= 'err_leaderboard';
    
    public static function insertleaderboarderrlist($row,$data){
        $errobjlead=new Errleaderboardlist();
        $errobjlead->upload_id=$data['upload_id'];
        $errobjlead->user_name=$row['user_name'];
        $errobjlead->obj_no=$row['objective_no'];
        $errobjlead->obj_text=$row['objective_text'];
        $errobjlead->error=$row['error'];
        $errobjlead->mobile_no=$row['user_mobile_no'];
        $errobjlead->emp_code=$row['user_employee_code'];
        $errobjlead->rank=$row['user_rank'];
        $errobjlead->points=$row['user_points'];
        $errobjlead->status=$row['status'];
        $errobjlead->region=$row['region'];
        $errobjlead->zone=$row['zone'];
        //$errobjlead->territory=$row[''];
        $errobjlead->client_name=$row['client_name'];
        $errobjlead->created_ts=$row['created_ts'];
        $errobjlead->created_by=Session::get('UserId');
        $errobjlead->save();
        return $errobjlead;
    }
}
