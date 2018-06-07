<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsMembershipPack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('gs_membership_pack', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('package_name');
			 $table->longText('description');
            $table->string('amount');
            $table->string('currency');
			  $table->string('credit_score');
            
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
