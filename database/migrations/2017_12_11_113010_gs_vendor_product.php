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
            $table->text('description');
            $table->string('asin_url');
			$table->string('description_url');
            $table->string('images');
			$table->string('fair_value');
			$table->string('price');
            $table->string('units');
			$table->string('organisation_id');
			$table->string('product_category');
			$table->string('post_type');
			$table->string('tags');
            $table->string('user_id')->nullable();
            
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
        Schema::dropIfExists('gs_vender_product');
    }
}
