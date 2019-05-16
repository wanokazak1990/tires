<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_category extends Model
{
    protected $fillable = [
        'name','status'
    ];

    public static function getAllToSelect()
    {
    	$array = [];
    	$list = self::pluck('name','id')->toArray();
    	if(count($list))
    		$tmp = ['null'=>'Любая'];
    		$array = $tmp+$list;
    	return $array;
    }
}
