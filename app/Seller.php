<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
 protected $table="gs_vender_organisation";
    protected $fillable = [
        'title','description','location','pic','year_in_buisness','start_up_year','address','mission_statement','vision_statement','tax_id','phone_number','business_type'
    ];

    
}
