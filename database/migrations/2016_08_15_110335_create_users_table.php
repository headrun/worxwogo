<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id',true);
            $table->string('name');
            $table->string('emp_code')->unique();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('upload_id')->unsigned()->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('mobilenumber',10)->unique();
            $table->string('branch')->nullable();
            $table->string('zone')->nullable();
            $table->string('designation')->nullable();
            $table->string('user_level_name')->nullable();
            $table->integer('user_level')->nullable();
            $table->string('user_levelimg_path')->nullable();
            $table->integer('user_points')->nullable();
            $table->string('user_photo_path')->nullable();
            $table->enum('user_type', array("ADMIN","USER"));
            $table->string('location_name')->nullabel();
            $table->string('reporting_user')->nullable();
            $table->string('reporting_name')->nullable();
            $table->string('reporting_designation')->nullable();
            
            $table->string('created_ts');
            $table->enum('status', array("A","N"));
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('upload_id')->references('id')->on('upload_status');
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
        Schema::drop('users');
    }
}
