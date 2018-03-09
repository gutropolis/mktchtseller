<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
 protected $table="gs_message";
    protected $fillable = [
   'inbox_id','sender_id','reciever_id','reciever_read','message'
    ];
	public function author()
	{
		return $this->belongsTo(User::class,'user_id','user_name','role');
	}

}
