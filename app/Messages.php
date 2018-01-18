<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
 protected $table="message";
    protected $fillable = ['reciever_id','message','subject','post_id','post_type','reciever' ];

			public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
}
