<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('upload_status', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('client_id')->unsigned();
            $table->enum('insert_table', array("USER","OBJECTIVE_LIST","OBJECTIVES_PROGRESS","OBJECTIVE_LEADERBOARD"));
            $table->string('upload_error');
            $table->enum('status', array("SUCCESS","FAILURE"));
            $table->timestamps();
            
        });
        
        Schema::table('upload_status', function($table) {
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::drop('upload_status');
    }
}
