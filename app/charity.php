<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class charity extends Model
{
    protected $table = 'gs_charity_organisation';

    protected $fillable = [
        'title','description','location','images','year_in_business',
		'start_up_year','business_purpose','address','phone_number',
		'keyword','vision_statement','mission_statement','tags'
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
}
