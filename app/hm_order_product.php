<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_order_product extends Model
{
    protected $fillable = [
    	'order_id','product_id','count','saleprice'
    ];

    public function originalProduct()
    {
    	return $this->hasOne('App\hm_product','id','product_id');
    }
}
