<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_feedback extends Model
{
    protected $fillable = [
    	'name', 'text', 'status'
    ];
}
