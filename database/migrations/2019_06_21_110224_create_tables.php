<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
        });
        
        Schema::create('cities', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger("region_id");
            $table->string('name');
    
            $table->foreign("region_id")->references("id")->on("regions");
        });
        
        Schema::create('address', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
        });
        
        
        Schema::create('centers', function(Blueprint $table){
            $table->bigIncrements('id');
            
            $table->string('center_name');
            $table->string('phone');
            
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('city_id');
            
            $table->string('okrug');
            $table->string('big')->nullable();
            $table->string('email')->nullable();
            $table->string('devices')->nullable();
            $table->string('shifts')->nullable();
            
            $table->foreign("region_id")->references("id")->on("regions");
            $table->foreign("city_id")->references("id")->on("cities");
            
            $table->timestamps();
            
        });
    
    
        Schema::create('maps', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger("center_id");
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedInteger('capacity')->default(0);
        });
    
        Schema::create('centers_address', function(Blueprint $table){
            $table->unsignedBigInteger("center_id");
            $table->unsignedBigInteger("address_id");
        });
    
        Schema::create('centers_map', function(Blueprint $table){
            $table->unsignedBigInteger("center_id");
            $table->unsignedBigInteger("map_id");
        });
        

        
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
