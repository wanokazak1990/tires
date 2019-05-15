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
    			return 'Новый заказ, связаться с клиентом';
    			break;
    		case 2:
    			return 'Заказ обработан, ожидается клиент';
    			break;
    		case 3:
    			return 'Заказ закрыт, товар выдан';
    			break;
    		case 4:
    			return 'Заказ отменён, клиент отказался';
    			break;
    		
    		default:
    			return 'Неизвестно';
    			break;
    	}
    }

    public function statusArr()
    {
    	return [
    		1=>'Заказ новый, связаться с клиентом',
    		2=>'Заказ обработан, ожидается клиент',
    		3=>'Заказ закрыт, товар выдан',
    		4=>'Заказ отменён, клиент отказался'
    	];
    }

    public function orderTotalPrice($format='numeric')
    {
    	$totalPrice = 0;
    	if(!empty($this->products))
    		foreach ($this->products as $key => $prod) 
    		{
    			$totalPrice+=($prod->count*$prod->saleprice);
    		}

    	switch ($format) {
    		case 'numeric':
    			return $totalPrice;
    			break;
    		case 'money':
    			return number_format($totalPrice,0,'',' ');
    			break;
    		
    		default:
    			return $totalPrice;
    			break;
    	}
    }
}
