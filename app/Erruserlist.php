<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Erruserlist extends Model
{
    
        protected $table = 'err_user_list';
    //
        
       public static function insertusererrlist($row,$data){
           $erruserlist=new Erruserlist();
           $erruserlist->name=$row['user_name'];
           $erruserlist->emp_code=$row['user_emp_code'];
           $erruserlist->client_id=$data['client_id'];
           $erruserlist->client_name=$row['client_name'];
           $erruserlist->error=$row['error'];
           $erruserlist->upload_id=$data['upload_id'];
           $erruserlist->mobilenumber=$row['user_mobile'];
           $erruserlist->territory=$row['territory'];
           $erruserlist->region=$row['region'];
           $erruserlist->designation=$row['designation'];
           $erruserlist->user_level_name=$row['user_level_name'];
           $erruserlist->user_level_image_name=$row['user_level_image_name'];
           $erruserlist->user_points=$row['user_points'];
           $erruserlist->created_ts=$row['created_ts'];
           $erruserlist->status=$row['status'];
           $erruserlist->reporting_user=$row['reporting_user'];
           $erruserlist->reporting_name=$row['reporting_name'];
           $erruserlist->reporting_desg=$row['reporting_desg'];
           $erruserlist->save();
           return $erruserlist;
       }
}
