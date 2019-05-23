<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_client extends Model
{
    protected $fillable = [
    	'name','mail','phone'
    ];

    public function order()
    {
    	return $this->belongsTo('App\hm_order','id','client_id');
    }

    
}
