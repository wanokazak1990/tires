<?php
namespace App\Helpers\Cart;
use Illuminate\Support\Facades\Facade;

Class CartFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Cart';
	}
}