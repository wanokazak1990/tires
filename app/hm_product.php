<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_product extends Model
{
    protected $fillable = [
        'name', 'category_id', 'status', 'price', 'available', 'img', 'article', 'description'
    ];

    public function getUrlImg()
    {
        $file = pathinfo($this->img)['basename'];
        return asset('storage/products/'.$file);
    }

    public function category()
    {
        return $this->hasOne('App\hm_category','id','category_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\hm_product_attribute','product_id','id')->with('parameter')->with('attrName');
    }

    public function getSmallAttribute($attr)
    {
        $mas = [];
        if(is_object($attr) && count($attr))
        foreach ($attr as $key => $a) 
            {
                if($a->attrName->status)
                    $mas[] = $a->parameter->value;
            }

        return join($mas,', ');
    }
}
