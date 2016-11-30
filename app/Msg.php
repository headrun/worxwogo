<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Msg extends Model
{
	protected $table = 'msg';

	
public static function addMsg($inputs){

	$newMsg=new Msg();
	$newMsg->from_sup=Session::get('empId');
	$newMsg->to_emp=$inputs['emp_id'];
	$newMsg->msg=$inputs['msg'];
	$newMsg->created_at=date('Y-m-d');
	$newMsg->updated_at=date('Y-m-d');
	$newMsg->save();
	return $newMsg;

} 

}
