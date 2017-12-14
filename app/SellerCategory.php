<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerCategory extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'gs_seller_type';

    protected $guarded = ['id'];

    public function seller()
    {
        return $this->hasMany(Seller::class);
    }

}
