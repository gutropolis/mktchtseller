<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class charity extends Model
{
    protected $table="gs_charity_organisation";
   protected $fillable = [
        'title','description','location','images','year_in_business',
		'start_up_year','business_purpose','address','phone_number',
		'keyword','vision_statement','mission_statement','tags'
		];
}
