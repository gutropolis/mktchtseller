<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
 protected $table="message";
    protected $fillable = [
   'title','message','reciever_id','post_id','post_type','reciever'
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
