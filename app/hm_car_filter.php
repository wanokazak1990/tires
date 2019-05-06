<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_car_filter extends Model
{

	public $timestamps = false;
	
    public static function getBrands()
    {
    	$list = self::groupBy('vendor')->pluck('vendor');
    	return $list;
    }
}
