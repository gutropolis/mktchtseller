<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsMessageinbox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_messageinbox', function (Blueprint $table) {
            $table->increments('id');
			$table->string('sender_id');
			$table->string('reciever_id');
			$table->string('post_id');
			$table->string('subject');
			$table->string('post_type');
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
        Schema::dropIfExists('gs_messageinbox');
    }
}