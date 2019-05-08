<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_order extends Model
{
    protected $fillable = [
    	'client_id','status','type'
    ];
}
