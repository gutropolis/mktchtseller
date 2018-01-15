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
{
        Schema::create('my_ads', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('title')->default();
            
            $table->string('description')->default();
            $table->string('image')->default();
            $table->string('user_id')->default();
            $table->string('location')->default();
            $table->string('ads_type')->default();
            $table->string('views')->default();
            $table->string('like')->default();
           
                        
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
