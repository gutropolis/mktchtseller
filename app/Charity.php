<?php

namespace App;

use Illuminate\Database\Eloquent\Model;        
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Charity extends Model
{
    protected $table = 'gs_charity_organisation';

    protected $fillable = [
        'title','description','location','images','country',
		'state','city','postal_code','area_code','phone_number','address',
		'website','vision_statement','mission_statement','charity_type','tags','user_id','updated_by','post_type',
		];
    
        protected $guarded = ['id'];
    
        
        public function category()
        {
            return $this->belongsTo(CharityCategory::class,'charity_type');
        }
        
        public function getCharityCategoryAttribute()
        {
            return $this->category->pluck('id');
        }
		public function author()
  {
   return $this->belongsTo(User::class, 'user_id','user_name');
  }
}
