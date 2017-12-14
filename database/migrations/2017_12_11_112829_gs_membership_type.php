<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsMembershipType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_membership_type', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('duration');
            
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
        Schema::dropIfExists('gs_membership_type');
    }
}
