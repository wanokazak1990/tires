<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class my_slider extends Model
{
    protected $fillable = ['title', 'img', 'text', 'link', 'status'];

    public function getUrlImg()
    {
    	$file = pathinfo($this->img)['basename'];
        return asset('storage/sliders/'.$file);
    }
}

