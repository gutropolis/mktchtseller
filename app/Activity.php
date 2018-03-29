<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
 protected $table="gs_activity_log";
    protected $fillable = [
   'user','description','subject_id','subject-_url','cause_id','cause'
    ];
public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
    
}
