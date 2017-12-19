<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    protected $table="gs_membership_type";
    protected $fillable = [
        'title','description','duration'
    ];

    
}
