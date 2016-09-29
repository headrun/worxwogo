<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Errobjlist extends Model
{
    //
    protected $table = 'err_obj_list';
    
    public static function insertobjerrlist($row,$data){
        $errobjlist=new Errobjlist();
        
        $errobjlist->client_id=$data['client_id'];
        $errobjlist->upload_id=$data['upload_id'];
        $errobjlist->obj_id=$row['objective_no'];
        $errobjlist->objective_name=$row['objective_text'];
        $errobjlist->status=$row['status'];
        $errobjlist->error=$row['error'];
        $errobjlist->created_ts=$row['created_ts'];
        $errobjlist->created_by=Session::get('userId');
        $errobjlist->save();
        
    }
}
