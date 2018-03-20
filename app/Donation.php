<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
 protected $table="gs_donation";
    protected $fillable = [
	'seller_id','seller','product','units','charity_organisation','status','is_certify'
   
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
