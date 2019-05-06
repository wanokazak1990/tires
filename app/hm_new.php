<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_new extends Model
{
    protected $fillable = [
    	'title', 'alias', 'text', 'img', 'status'
    ];

    public function getUrlImg()
    {
    	$file = pathinfo($this->img)['basename'];
        return asset('storage/news/'.$file);
    }
}
