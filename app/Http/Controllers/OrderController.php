<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_order as order;
use App\hm_client as client;
use App\hm_order_product as orderProduct;
use App\hm_product as product;

class OrderController extends Controller
{
    public function index()
    {
    	$orders = order::with('client')->orderBy('status')->orderBy('id')->paginate(40);
    	return view('admin.order')
	    	->with('title','Список заказов')
	    	->with('list',$orders);
    }

    public function show($id, Request $request)
    {
    	if($request->isMethod('get'))
    	{
	    	$order = order::with('client')->with('products')->find($id);
	    	return view('admin.order')
		    	->with('title','Заказ №'.$order->id.' от '.$order->created_at->format('d.m.Y h:m'))
		    	->with('order',$order);
	    }
    }
}
