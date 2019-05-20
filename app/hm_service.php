<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_service extends Model
{
	
	protected $fillable = [
    	'name','text','alias','img','status','icon'
    ];

    public function getUrlImg()
    {
    	$file = pathinfo($this->img)['basename'];
        return asset('storage/services/'.$file);
    }
}
