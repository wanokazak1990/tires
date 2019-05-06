<?php
namespace App\Helpers\Cart\Realisation;
use App\hm_product as Product;
Class Contents
{
	public $id = null;
	public $price = null;
	public $count = null;
	public $name = null;
	public $img = null;
	public $item_price = null;

	public function __construct(Product $product, $count=1)
	{
		$this->id = $product->id;
		$this->price = $product->price;
		$this->name = $product->name;
		$this->count = $count;
		$this->img = $product->getUrlImg();
		$this->item_price = $this->price*$this->count;
	}

	public function setItemPrice()
	{
		$this->item_price = $this->price*$this->count;
	}
}