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
            $table->string('site_title');
            
            $table->string('description');
            $table->string('keyword');
            $table->string('site_url');
            $table->string('site_logo');
            $table->string('base_url');
            $table->string('admin_email');
            $table->string('upload_path');
            $table->string('smtp_server');
            $table->string('smtp_user');
            $table->string('smtp_password');
            $table->string('smtp_host');
                        
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
