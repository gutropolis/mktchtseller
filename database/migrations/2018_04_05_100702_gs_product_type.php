<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsProductType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_product_type', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('description');
           
            $table->string('updated_by')->nullable();
			$table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('gs_product_type');
    }
}
