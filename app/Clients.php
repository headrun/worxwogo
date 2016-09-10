<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use SoftDeletes;
class Clients extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];
   protected $table="clients";
   
   static public function addnewClient($data){
       $newclient=new Clients();
       $newclient->client_name=$data['client_name'];
       $newclient->status=$data['status'];
       $newclient->save();
       return $newclient;
   }
   
}
