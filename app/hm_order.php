<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hm_order extends Model
{
    protected $fillable = [
    	'client_id','status','type'
    ];

    public function client()
    {
    	return $this->hasOne('App\hm_client','id','client_id');
    }

    public function products()
    {
    	return $this->hasMany('App\hm_order_product','order_id','id')->with('originalProduct');
    }

    public function getType()
    {
    	switch ($this->type) {
    		case 1:
    			return 'Заказ с сайта';
    			break;
    		
    		default:
    			return 'Неизвестно';
    			break;
    	}
    }

    public function getStatus()
    {
    	switch ($this->status) {
    		case 1:
    			return 'Новый заказ';
    			break;
    		case 2:
    			return 'В обработке';
    			break;
    		case 3:
    			return 'Закрытый заказ';
    			break;
    		case 4:
    			return 'Отменёный заказ';
    			break;
    		
    		default:
    			return 'Неизвестно';
    			break;
    	}
    }
}
