<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
 protected $table="gs_cms";
    protected $fillable = [
   'title','meta_keyword','description','meta_desc','meta_title','slug','guide'
    ];
public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
    
}
