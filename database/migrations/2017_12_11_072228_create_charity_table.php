<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_organisation', function (Blueprint $table) {
           $table->text('name')->nullable();
			$table->string('location')->nullable();
			$table->date('yearinbussiness')->nullable();
			$table->string('pic')->nullable();
			$table->string('video')->nullable();
			$table->string('aboutus')->nullable();
			$table->string('howtheycanbehelp')->nullable();
			$table->string('charityaddress')->nullable();
            $table->string('phon')->nullable();
            $table->string('chatid')->nullable();
            $table->string('visionstatement')->nullable();
            $table->string('missionstatement')->nullable();
            $table->string('tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charity', function(Blueprint $table)
		{
			// delete above columns
			$table->dropColumn(array('name', 'location', 'yearinbussiness', 'pic', 'video', 'aboutus', 'howtheycanbehelp', 'charityaddress', 'phon','chatid','visionstatement','missionstatement','tags'));
		});
    }
}
