<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('obj_progress', function (Blueprint $table) {
            $table->increments('id',true);
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('obj_list_id')->unsigned();
            $table->integer('upload_id')->unsigned()->nullable();
            
            $table->enum('objective_type', array("TARGET","RANGE","QTY"));
            $table->string('objective_datatype')->nullable();
            
            $table->string('targetmnth/cycle')->nullable();
            $table->integer('targetvalue')->nullable();
            
            $table->decimal('targetachpercentage',5,2)->nullable();
            $table->integer('targetachvalue')->nullable();
            $table->string('targetvalueunits')->nullable();
            $table->string('targetobjskewindicator')->nullable();
            $table->integer('targetobjskewtarget')->nullable();
            
            $table->integer('segstartvalue')->nullable();
            $table->integer('segendvalue')->nullable();
            $table->decimal('segstartpercentage',5,2)->nullable();
            $table->decimal('segendpercentage',5,2)->nullable();
            $table->string('segvalueunits')->nullable();
            
            $table->decimal('seggoodstartpercentage',5,2)->nullable();
            $table->decimal('seggoodendpercentage',5,2)->nullable();
            $table->decimal('segbadstartpercentage',5,2)->nullable();
            $table->decimal('segbadendpercentage',5,2)->nullable();
            $table->decimal('segvgoodstartpercentage',5,2)->nullable();
            $table->decimal('segvgoodendpercentage',5,2)->nullable();
            
            $table->integer('segobjachvdvalue')->nullable();
            
            $table->integer('qtyhighestachno')->nullable();
            $table->integer('qtycurrentachno')->nullable();
            $table->string('qtyvalueunits')->nullable();
            $table->integer('objpoints');
            
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
         Schema::drop('obj_progress');
    }
}
