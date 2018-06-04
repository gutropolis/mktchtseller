<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
 protected $table="payment_setting";
    protected $fillable = [
	'id','email','stripe_secret_key','stripe_publishable_key','currency',
   
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
