<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Badges extends Model
{
    protected $table='badges';
    protected $fillable = array('client_id','mobile_no');
    //
    
    public static function insertBadges($data,$data2){
        $newbadge=Badges::firstOrNew(['client_id'=>$data2['client_id'],'mobile_no'=>$data['user_mobile_no']]);
        $newbadge->upload_id=$data2['upload_id'];
        $newbadge->user_name=$data['user_name'];
        $newbadge->mobile_no=$data['user_mobile_no'];
        $newbadge->emp_code=$data['user_employee_code'];
        $newbadge->client_id=$data2['client_id'];
        $newbadge->client_name=$data['client_name'];
        $newbadge->badge_name=$data['user_badge_name'];
        $newbadge->badge_img_name=$data['user_badge_image_name'];
        $newbadge->created_ts=$data['created_ts'];
        $newbadge->status=$data['status'];
        $newbadge->created_by=Session::get('userId');
        $newbadge->save();
        return$newbadge;
        
    }
}
