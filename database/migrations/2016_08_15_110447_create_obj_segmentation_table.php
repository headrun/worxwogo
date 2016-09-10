<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjSegmentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('obj_leaderboard', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('obj_list_id')->unsigned()->nullable();
            $table->integer('upload_id')->unsigned()->nullable();
            
            $table->integer('rank')->nullable();
            $table->integer('points')->nullable();
            
            $table->enum('status', array("A","NA","UF"));
            $table->string('created_ts');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('obj_list_id')->references('id')->on('obj_list');
            $table->foreign('upload_id')->references('id')->on('upload_status');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            
            
            
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
         Schema::drop('obj_segmentation');
    }
}
