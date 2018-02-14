<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sellerproduct extends Model
{
 protected $table="gs_vender_product";
    protected $fillable = [
        'title','description','asin_url','images','reviews','user_id','units'
    ];
	public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
    
}
