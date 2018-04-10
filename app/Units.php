<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
 protected $table="gs_request";
    protected $fillable = [
	'charity_id','charity','charity_name','product_id','units','status','image'
   
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
