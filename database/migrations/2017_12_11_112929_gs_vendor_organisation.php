<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsVendorOrganisation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_vender_organisation', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->string('pic');
            $table->string('year_in_business');
            $table->string('start_up_year');
			$table->string('address');
            $table->string('mission_statement');
            $table->string('vision_statement');
            $table->string('tax_id');
            $table->string('business_type');
            $table->string('phone_number');
            $table->string('user_id');
            
            $table->string('updated_by');
            
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
        Schema::dropIfExists('gs_vender_organisation');
    }
}
