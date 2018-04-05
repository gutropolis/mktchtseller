<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PCategory extends model
{
    use SoftDeletes;
    //protected $dates = ['deleted_at'];
    protected $table = 'gs_product_type';
    protected $guarded = ['id'];
   
   
	public function author()
  {
   return $this->belongsTo(User::class, 'user_id','user_name');
  }
	
}