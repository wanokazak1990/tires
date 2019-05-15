<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_attribute_value extends Model
{
    protected $fillable = [
        'attribute_id','value','status'
    ];
}
