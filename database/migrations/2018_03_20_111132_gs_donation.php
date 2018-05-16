<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsDonation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_donation', function (Blueprint $table) {
            $table->increments('id');
			$table->string('seller_id');
			$table->string('product_id');
			$table->string('post_id');
			$table->string('charity_id');
			$table->string('charity_owner_id');
			$table->string('units');
			$table->string('progress');
			$table->string('seller_read');
			$table->string('charity_read');
			$table->string('charity_status');
			$table->string('seller_status');
			$table->string('is_certify');
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
       Schema::dropIfExists('gs_donation');
    }
}
