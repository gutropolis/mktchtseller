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
			$table->text('product');
			$table->string('seller');
			$table->string('units');
			$table->string('owner_charity');
			$table->string('charity_organisation');
			$table->string('status');
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
