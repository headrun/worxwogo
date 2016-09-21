<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use SoftDeletes;
class Badges extends Model
{
    
    protected $dates = ['deleted_at'];
    protected $table='badges';
    
    //
    
    public static function insertBadges($data,$data2){
        $newbadge= new Badges();
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
