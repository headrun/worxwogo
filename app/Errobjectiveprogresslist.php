<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Errobjectiveprogresslist extends Model
{
    //
    protected $table='err_obj_progress';
    
    public static function inserterrobjectiveprogresslist($data,$data2){
        $newobjectiveprogress=new Errobjectiveprogresslist();
        $newobjectiveprogress->client_id=$data2['client_id'];
        $newobjectiveprogress->upload_id=$data2['upload_id'];
        $newobjectiveprogress->error=$data['error'];
        $newobjectiveprogress->user_name=$data['user_name'];
        $newobjectiveprogress->mobile_no=$data['user_mobile_no'];
        $newobjectiveprogress->emp_code=$data['user_employee_code'];
        $newobjectiveprogress->obj_text=$data['objective_text'];
        $newobjectiveprogress->obj_no=$data['objective_no'];
        $newobjectiveprogress->objective_type=$data['objective_type'];
        $newobjectiveprogress->objective_datatype=$data['data_type'];
        $newobjectiveprogress->	target_obj_mnth=$data['target_obj_month'];
        $newobjectiveprogress->	target_value=$data['target_obj_value'];
        $newobjectiveprogress->	target_value_units=$data['target_obj_value_units'];
        $newobjectiveprogress->	target_ach_percentage=$data['target_obj_ach_per'];
        $newobjectiveprogress->target_ach_value=$data['target_obj_ach_value'];
        $newobjectiveprogress->	target_to_be_ach_percentage=$data['target_obj_tobe_ach_per'];
        $newobjectiveprogress->	target_to_be_ach_val=$data['target_obj_tobe_ach_value'];
        $newobjectiveprogress->	target_obj_skew_indicator=$data['target_obj_skew_indicator'];
        $newobjectiveprogress->	target_obj_skew_target=$data['target_obj_skew_target'];
        $newobjectiveprogress->	seg_start_value=$data['seg_obj_start_value'];
        $newobjectiveprogress->	seg_end_value=$data['seg_obj_end_value'];
        $newobjectiveprogress->	seg_start_percentage=$data['seg_obj_start_per'];
        $newobjectiveprogress->	seg_end_percentage=$data['seg_obj_end_per'];
        $newobjectiveprogress->	seg_value_units=$data['seg_obj_value_units'];
        $newobjectiveprogress->	seg_good_start_percentage=$data['seg_obj_good_start_per'];
        $newobjectiveprogress->	seg_good_end_percentage=$data['seg_obj_good_end_per'];
        $newobjectiveprogress->	seg_bad_start_percentage=$data['seg_obj_bad_start_per'];
        $newobjectiveprogress->	seg_bad_end_percentage=$data['seg_obj_bad_end_per'];
        $newobjectiveprogress->	seg_vgood_start_percentage=$data['seg_obj_vgood_start_per'];
        $newobjectiveprogress->	seg_vgood_end_percentage=$data['seg_obj_vgood_end_per'];
        $newobjectiveprogress->	seg_obj_achvd_value=$data['seg_obj_ach_value'];
        
        $newobjectiveprogress->	seg_obj_target_value=$data['seg_obj_target_value'];
        $newobjectiveprogress->	seg_obj_target_value_units=$data['seg_obj_target_value_units'];
        $newobjectiveprogress->	seg_obj_txt=$data['seg_obj_txt'];
        
        $newobjectiveprogress->	qty_highest_ach_no=$data['qty_highest_ach_no'];
        $newobjectiveprogress->	qty_current_ach_no=$data['qty_current_ach_no'];
        $newobjectiveprogress->	qty_value_units=$data['qty_value_units'];
        $newobjectiveprogress->	obj_points=$data['objective_points'];
        $newobjectiveprogress->	status=$data['status'];
        $newobjectiveprogress->	client_name=$data['client_name'];
        $newobjectiveprogress->	created_ts=$data['created_ts'];
        $newobjectiveprogress->created_by=Session::get('userId');
        $newobjectiveprogress->save();
        return $newobjectiveprogress;
    }
}
