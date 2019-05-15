<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_page extends Model
{
    protected $fillable = [
        'title', 'alias', 'text', 'img', 'status' 
    ];

    public function getUrlImg()
    {
    	$file = pathinfo($this->img)['basename'];
        if ($file)
            return asset('storage/pages/'.$file);
        else
            return '';
    }
}
