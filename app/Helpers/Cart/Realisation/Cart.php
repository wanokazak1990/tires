<?php
namespace App\Helpers\Cart\Realisation;

use Session; 
use App\Helpers\Cart\Realisation\Contents;
use App\hm_product as Product;

Class Cart
{
	public function test()
	{
		return 'Я класс для реализации корзины и я вроде как работаю';
	}

	public function checkOrSet()
	{
		if(!Session::has('cart'))
		{
			Session::put('cart','');
		}
	}

	public static function getCart()
	{
		if(Session::get('cart'))
			return Session::get('cart');
		else return [];
	}

	public function setCart($cart)
	{
		Session::put('cart',$cart);
	}

	public function add($id){
		if(is_numeric($id))
		{
			$Cart = self::getCart();

			if(is_array($Cart) && array_key_exists($id, $Cart))
			{			
				$Cart[$id]->count+=1;	
				$Cart[$id]->setItemPrice(); 		
			}
			else{
				$product = Product::find($id);
				if(is_array($Cart))
					$Cart[$product->id] = new Contents($product);
				else {
					$Cart = array();
					$Cart[$product->id] = new Contents($product);
				}
			}
			self::setCart($Cart);
		}
	}

	public function take($id)
	{
		if(is_numeric($id))
		{
			$Cart = self::getCart();
			if(is_array($Cart) && array_key_exists($id, $Cart))
			{
				if($Cart[$id]->count>1)
				{
					$Cart[$id]->count-=1;
					$Cart[$id]->setItemPrice(); 
				}
				else
					unset($Cart[$id]);
			}
			self::setCart($Cart);
		}
	}

	public function remove($id)
	{
		if(is_numeric($id))
		{
			$Cart = self::getCart();
			if(is_array($Cart) && array_key_exists($id, $Cart))
			{
				unset($Cart[$id]);
			}
			self::setCart($Cart);
		}
	}

	public function clearCart()
	{
		Session::forget('cart');
	}

	public function totalPrice($totalPrice = 0)
	{
		$Cart = self::getCart();
		if(is_array($Cart))
			foreach ($Cart as $key => $item) {
				$totalPrice+=($item->count*$item->price);
			}
		return $totalPrice;
	}

	public function totalCount($totalCount = 0)
	{
		$Cart = self::getCart();
		if(is_array($Cart))
			foreach ($Cart as $key => $item) {
				$totalCount+=($item->count);
			}
		return $totalCount;
	}

	public function itemCount($id)
	{
		$Cart = self::getCart();
		if(is_array($Cart) && array_key_exists($id, $Cart))
			return $Cart[$id]->count;
	}

	public function itemPrice($id)
	{
		$Cart = self::getCart();
		if(is_array($Cart) && array_key_exists($id, $Cart))
			return $Cart[$id]->count*$Cart[$id]->price;
	}

	public function moveToClient($id)
	{
		$array = [
			'total_count'=>$this->totalCount(),
			'total_price'=>$this->totalPrice(),
			'item_count'=>$this->itemCount($id),
			'item_price'=>$this->itemPrice($id)
		];
		return json_encode($array);
	}

	public function cartIndikator()
	{
		$array = [
			'total_count'=>$this->totalCount(),
			'total_price'=>$this->totalPrice()
		];
		return json_encode($array);
	}

	public function getCartByParam($param)
	{
		$arr = [];
		foreach (Cart::getCart() as $mas) {
			$arr[] = $mas->$param;
		}
		return $arr;
	}
}