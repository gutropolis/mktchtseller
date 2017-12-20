<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CharityCategory extends model
{
    use SoftDeletes;
    //protected $dates = ['deleted_at'];
    protected $table = 'gs_charity_type';
    protected $guarded = ['id'];
    public function charity()
    {
        return $this->hasMany(charity::class);
    }
    public function parent()
    {
        return $this->belongsTo('CharityCategory', 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany('CharityCategory', 'parent_id');
    }
	public function author()
  {
   return $this->belongsTo(User::class, 'user_id','user_name');
  }
	
}