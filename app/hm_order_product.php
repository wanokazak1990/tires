<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_order_product extends Model
{
    protected $fillable = [
    	'order_id','product_id','count','saleprice'
    ];
}
