<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_order as order;
use App\hm_client as client;
use App\hm_order_product as orderProduct;
use App\hm_product as product;
use Session;

class OrderController extends Controller
{
    public $link = ['orderActive'=>'active'];

    public function index()
    {
    	Session::forget('orderPrevPage');
    	$orders = order::with('client')->orderBy('status')->orderBy('id')->paginate(30);
    	return view('admin.order')
	    	->with('title','Список заказов')
            ->with($this->link)
	    	->with('list',$orders);
    }

    public function show($id, Request $request)
    {
    	if(!Session::has('orderPrevPage'))
    	{
    		$str = url()->previous();
    		if(explode('?',url()->previous())[0]!=route('orderindex'))
    		 	Session::put('orderPrevPage', route('orderindex'));
    		else
    			Session::put('orderPrevPage', url()->previous());
    	}

    	$order = order::with('client')->with('products')->find($id);
    	
	    if($request->isMethod('post'))
	    {
	    	if($request->has('status'))
	    	{
	    		$order->status = $request->status;
	    		$order->update();
	    	}
	    }
	    return view('admin.order')
		    	->with('title','Заказ №'.$order->id.' от '.$order->created_at->format('d.m.Y h:m'))
                ->with($this->link)
		    	->with('order',$order);
    }
}
