<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsUserActivityFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		 Schema::create('gs_user_activity_feed', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('sender_id');
            $table->string('reciever_id');
            $table->string('subject');
			$table->string('post_type');
            $table->string('post_id');
            $table->string('link');
            $table->string('read_to');
            $table->string('read_by_admin');
            $table->string('area_code');
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
        Schema::dropIfExists('gs_user_activity_feed');
    }
}
