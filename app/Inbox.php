<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
 protected $table="gs_messageinbox";
    protected $fillable = [
   'sender_id','reciever_id','subject','post_id','post_type','subject'
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
