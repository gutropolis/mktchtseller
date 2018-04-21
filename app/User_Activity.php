<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Activity extends Model
{
 protected $table="gs_user_activity_feed";
    protected $fillable = [
					'from','to','subject','post_id','link','read_to','read_by_admin',
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
