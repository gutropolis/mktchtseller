<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
 protected $table="gs_subscription";
    protected $fillable = [
   'user_id','membership_id','package_id','stripe_email','credit','stripe_id','remaining_credit','status'
    ];
public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
    
}
