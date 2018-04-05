<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'gs_product_type';

    protected $guarded = ['id'];

    public function seller()
    {
        return $this->hasMany(Seller::class);
    }
public function author()
		{
			return $this->belongsTo(User::class, 'user_id','user_name');
		}
}
