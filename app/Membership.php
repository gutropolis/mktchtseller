<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table="gs_membership_pack";
    protected $fillable = [
        'package_name','amount','currency','credit_score'
    ];

    
	
}
