<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_client extends Model
{
    protected $fillable = [
    	'name','mail','phone'
    ];
}
