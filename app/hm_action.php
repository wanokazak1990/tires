<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_action extends Model
{
    protected $fillable = [
    	'name','text','alias','img','status'
    ];

    public function getUrlImg()
    {
    	$file = pathinfo($this->img)['basename'];
        return asset('storage/actions/'.$file);
    }
}
