<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CharityCategory extends Model {

   // use SoftDeletes;

    //protected $dates = ['deleted_at'];

    protected $table = 'gs_charity_type';
	 protected $fillable = [
        'title','description','parent_id','updated_by'
		];

    
}
