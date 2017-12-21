<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
 protected $table="gs_vender_organisation";
    protected $fillable = [
        'title','description','location','pic','year_in_business','start_up_year','address','mission_statement','vision_statement','tax_id','user_id','phone_number','business_type'
    ];

			public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
}
