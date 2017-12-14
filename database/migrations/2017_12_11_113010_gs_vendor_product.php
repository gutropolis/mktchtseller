<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsVendorProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_vender_product', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('asin_url');
            $table->string('images');
            $table->string('reviews');
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
        Schema::dropIfExists('gs_vender_product');
    }
}
