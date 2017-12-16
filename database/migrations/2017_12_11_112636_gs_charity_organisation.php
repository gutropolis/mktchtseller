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
            $table->string('location');
            $table->string('images');
            $table->string('year_in_business');
            $table->string('start_up_year');
            $table->string('business_purpose');
            $table->string('address');
            $table->string('phone_number');
            $table->string('keyword');
            $table->string('vision_statement');
            $table->string('mission_statement');
            $table->string('tags');
            $table->string('user_id');
            $table->string('charity_type');
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
