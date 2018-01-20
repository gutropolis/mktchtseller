<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Message extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('message', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('sender_id')->nullable();
            $table->string('reciever_id');
            $table->string('title');
            $table->string('reciever');
           $table->string('sender')->nullable();
            $table->string('message');
			$table->string('sender_read');
            $table->string('reciever_read');
            $table->string('post_id');
            $table->string('post_type');
            $table->string('updated_by')->nullable();
            
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
    }
}
