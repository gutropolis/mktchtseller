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
            $table->string('site_title')->nullable();
            
            $table->string('description')->nullable();
            $table->string('keyword')->nullable();
            $table->string('site_url')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('base_url')->nullable();
            $table->string('admin_email')->nullable();
            $table->string('upload_path')->nullable();
            $table->string('smtp_server')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_host')->nullable();
                        
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
