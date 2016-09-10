<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use session;

class Uploadstatus extends Model
{
    
    protected $table = 'upload_status';
    
    static public function insertuploadstatus($data){
        
        $insertUploadStatus=new Uploadstatus();
        $insertUploadStatus->client_id=$data['client_id'];
        $insertUploadStatus->insert_table=$data['insert_table'];
        $insertUploadStatus->status=$data['status'];
        $insertUploadStatus->save();
        return $insertUploadStatus;
        
    }






    //
}
