<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('obj_list', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('client_id')->unsigned();
            $table->integer('upload_id')->unsigned()->nullable();
          //  $table->string('user_emp_code');
            $table->string('objective_name');
            
            $table->enum('status', array("A","N","UF"));
            $table->string('created_ts');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('upload_id')->references('id')->on('upload_status');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
          //  $table->foreign('user_emp_code')->references('emp_code')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('obj_master');
    }
}
