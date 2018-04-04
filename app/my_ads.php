<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class my_ads extends Model
{
 protected $table="my_ads";
    protected $fillable = [
        'title','description','image','organisation_id','ads_type','views','like'
    ];

			public function author()
		{
			return $this->belongsTo(Seller::class, 'organisation_id');
		}
}
