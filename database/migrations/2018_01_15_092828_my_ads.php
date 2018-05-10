<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MyAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
        Schema::create('my_ads', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('title')->nullable();
            
            $table->string('description')->nullable();
           
            $table->string('user_id')->nullable();
           
            $table->string('charity_organisation')->nullable();
			$table->string('status')->nullable();
            $table->string('views')->nullable();
            $table->string('like')->nullable();
           
                        
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
 Schema::dropIfExists('my_ads');
    }
}
