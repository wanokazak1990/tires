<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_product_attribute extends Model
{
    protected $fillable = [
        'product_id', 'attribute_id', 'value_id'
    ];

    public function parameter()
    {
        return $this->hasOne('App\hm_attribute_value','id','value_id');
    }

    public function parameters()
    {
        return $this->hasMany('App\hm_attribute_value','attribute_id','attribute_id');
    }

    public function attrName()
    {
    	return $this->hasOne('App\hm_attribute','id','attribute_id');
    }
}
