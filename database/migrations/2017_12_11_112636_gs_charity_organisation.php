<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsCharityOrganisation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_charity_organisation', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('city');
            $table->string('images');
            $table->string('country');
            $table->string('state');
            
            $table->string('area_code');
			$table->string('postal_code');
            $table->string('phone_number');
            $table->string('website');
            $table->string('vision_statement');
            $table->string('mission_statement');
            $table->string('tags');
			$table->string('post_type');
			 $table->string('updated_by')->nullable();
            $table->string('user_id')->nullable();
			
            $table->string('charity_type')->nullable();
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
        Schema::dropIfExists('gs_charity_organisation');
    }
}
