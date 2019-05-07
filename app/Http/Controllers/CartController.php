<?php

namespace App\Http\Controllers;
use Session;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function append(Request $request)
    {
    	if($request->has('id'))
    	{
    		Cart::add($request->id);
    		echo Cart::moveToClient($request->id);
    	}
    }
    public function take(Request $request)
    {
    	if($request->has('id')){
    		Cart::take($request->id);    		
    		echo Cart::moveToClient($request->id);
    	}
    }
    public function remove(Request $request)
    {
    	if($request->has('id'))
    	{
    		Cart::remove($request->id);
    		echo Cart::moveToClient($request->id);
    	}
    }

    public function show(Request $request)
    {
        if($request->has('val'))
        {
            $res = Cart::getCartByParam($request->val);
            echo json_encode($res);
            return;
        }

    	$array = [
    		'cart'=>Cart::getCart(),
    		'total_price'=>Cart::totalPrice()
    	];
    	echo json_encode($array);
    }

    public function cartIndikator()
    {
        echo Cart::cartIndikator();
    }

    public function order(Request $request)
    {
        $data = $request->all();
        if(isset($data['name']) && isset($data['phone']) && isset($data['mail']))
            echo "1";
    }
}
