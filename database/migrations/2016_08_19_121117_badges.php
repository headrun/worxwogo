<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Badges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
        
        Schema::create('badges', function (Blueprint $table) {
           $table->increments('id',true);
           $table->integer('user_id')->unsigned()->nullable();
           $table->string('badge_name');
           $table->string('badge_img_path');
           $table->string('created_ts');
           $table->enum('status', array("A","N"));
           $table->timestamps();
           
           $table->foreign('user_id')->references('id')->on('users');
           $table->softDeletes();
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
    }
}
