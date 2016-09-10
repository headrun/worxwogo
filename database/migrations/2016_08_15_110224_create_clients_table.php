<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id',true);
            $table->string('client_name')->unique();
            $table->string('client_logo_path')->nullable();
            $table->integer('noofusers');
            $table->enum('status', array("A","N"));
            $table->softDeletes();
            $table->timestamps();
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
        Schema::drop('clients');
    }
}
