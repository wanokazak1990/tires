<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_service_client extends Model
{
    protected $fillable = [
    	'name','phone','date','time','comment'
    ];
}
