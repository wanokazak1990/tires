<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{
    protected $fillable = ['count'];

    public function getDays($key)
    {
    	switch ($key) {
    		case '0':
    			return 'Сегодня';
    			break;
    		case '1':
    			return 'Вчера';
    			break;
    		case '2':
    			return 'Позавчера';
    			break;
    		
    		default:
    			return 'Более трёх дней назад';
    			break;
    	}
    }
}
