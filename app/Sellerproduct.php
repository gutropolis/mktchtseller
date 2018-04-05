<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sellerproduct extends Model
{
 protected $table="gs_vender_product";
    protected $fillable = [
        'title','description','asin_url','product_category','images','reviews','user_id','description_url','units','tags','organisation_id'
    ];
	public function author()
		{ 
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
    
}
