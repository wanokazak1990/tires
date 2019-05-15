<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_attribute extends Model
{
    protected $fillable = [
        'name', 'category_id','status'
    ];

    public function category()
    {
    	return $this->hasOne('App\hm_category','id','category_id');
    }

    public function values()
    {
    	return $this->hasmany('App\hm_attribute_value','attribute_id','id');
    }
}
