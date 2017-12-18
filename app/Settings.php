<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Settings extends Model
{
    protected $table = 'gs_setting';

    protected $fillable = ['site_title','description','keyword','site_url','site_logo','base_url',
	'admin_email','upload_path','smtp_server','smtp_user','smtp_password','smtp_host'
        
		];
    
       
}
