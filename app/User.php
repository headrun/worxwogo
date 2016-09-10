<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Session;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','client_id','mobilenumber'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    
    static public function insertUsers($data,$data2){
        $newuser= User::firstOrNew(['mobilenumber'=>$data['user_mobile'],'emp_code'=>$data['user_emp_code'],'client_id'=>$data2['client_id']]);
        $newuser->name=$data['user_name'];
        $newuser->client_id=$data2['client_id'];
        $newuser->mobilenumber=$data['user_mobile'];
        $newuser->upload_id=$data2['upload_id'];
        $newuser->emp_code=$data['user_emp_code'];
        $newuser->territory=$data['territory'];
        $newuser->reporting_user=$data['reporting_user'];
        $newuser->reporting_name=$data['reporting_name'];
        $newuser->reporting_designation=$data['reporting_desg'];
        $newuser->user_level_name=$data['user_level_name'];
        $newuser->user_level_img_path=$data['user_level_image_name'];
        $newuser->user_points=$data['user_points'];
        $newuser->created_ts=$data['created_ts'];
        $newuser->status=$data['status'];
        $newuser->region=$data['region'];
        $newuser->designation=$data['designation'];
        $newuser->client_name=$data['client_name'];
        $newuser->user_type='USER';
        $newuser->created_by=Session::get('userId');
        $newuser->save();
        return $newuser;
    }
        
    
    static public function insertUser($data){
        
        $newuser= new User();
        
        $newuser->mobilenumber=$data['mobilenumber'];
        $newuser->name=$data['name'];
        $newuser->client_id=Session::get('clientId');
        $newuser->upload_id=$data['upload_id'];
        $newuser->user_type='USER';
        $newuser->active=1;
        $newuser->created_by=Session::get('userId');
        $newuser->save();
    }
}
