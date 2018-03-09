<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_message', function (Blueprint $table) {
            $table->increments('id');
			$table->int('inbox_id');
			$table->int('sender_id');
			$table->int('reciever_id');
			$table->string('message');
			$table->string('reciever_read');
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
        Schema::dropIfExists('gs_message');
    }
}
