<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cms extends Model
{
 protected $table="gs_cms";
    protected $fillable = [
   'title','meta_keyword','description','meta_desc','meta_title','slug','guide'
    ];

    
}
