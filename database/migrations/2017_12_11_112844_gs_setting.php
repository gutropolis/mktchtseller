<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GsSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gs_setting', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('site_title')->default();
            
            $table->string('description')->default();
            $table->string('keyword')->default();
            $table->string('site_url')->default();
            $table->string('site_logo')->default();
            $table->string('base_url')->default();
            $table->string('admin_email')->default();
            $table->string('upload_path')->default();
            $table->string('smtp_server')->default();
            $table->string('smtp_user')->default();
            $table->string('smtp_password')->default();
            $table->string('smtp_host')->default();
                        
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
        Schema::dropIfExists('gs_setting');
    }
}
