<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_order as order;
use App\hm_client as client;
use App\hm_order_product as orderProduct;
use App\hm_product as product;
use Session;
use DB;

class OrderController extends Controller
{
    public $link = ['orderActive'=>'active'];

    public function index(Request $request)
    {
    	Session::forget('orderPrevPage');

        $filter = array();
        
        $orders = order::with('client')->with('products');

        if(!$request->has('cancel'))
        {   
            // Фильтр поиска заказов:

            // Статус:
            if ($request->has('status') && $request->status != 0)
                $orders = $orders->where('status', '=', $request->status);

            // Дата от:
            if ($request->has('datefrom') && $request->datefrom != null)
                $orders = $orders->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->datefrom)));
            
            // Дата до:
            if ($request->has('dateto') && $request->dateto != null)
                $orders = $orders->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->dateto)));
            
            // Сумма от:
            if ($request->has('pricefrom') && $request->pricefrom != null && is_numeric($request->pricefrom))
            {
                $orders = $orders->where(DB::raw("(SELECT sum(hm_order_products.saleprice * hm_order_products.count) FROM hm_order_products WHERE hm_order_products.order_id = hm_orders.id)"), '>=', $request->pricefrom);
            }
            
            // Сумма до:
            if ($request->has('priceto') && $request->priceto != null && is_numeric($request->priceto))
            {
                $orders = $orders->where(DB::raw("(SELECT sum(hm_order_products.saleprice * hm_order_products.count) FROM hm_order_products WHERE hm_order_products.order_id = hm_orders.id)"), '<=', $request->priceto);
            }
            
            // Телефон:
            if ($request->has('phone') && $request->phone != null && is_numeric($request->phone))
            {
                $orders = $orders->where(DB::raw('(SELECT phone FROM hm_clients WHERE hm_clients.id = hm_orders.client_id)'), '=', $request->phone);
            }
           
            // Email:
            if ($request->has('email') && $request->email != null)
            {
                $orders = $orders->where(DB::raw('(SELECT mail FROM hm_clients WHERE hm_clients.id = hm_orders.client_id)'), '=', $request->email);
            }

            $filter = $request->all();
            unset($filter['_method']);
            unset($filter['_token']);
        }
        
        $orders = $orders->orderBy('status')->orderBy('id')->paginate(env('PAGINATE')); 
        
    	return view('admin.order')
	    	->with('title', 'Список заказов')
            ->with($this->link)
	    	->with('list', $orders)
            ->with('filter',$filter);
    }

    public function show($id, Request $request)
    {
    	if (!Session::has('orderPrevPage'))
    	{
    		$str = url()->previous();
    		if (explode('?',url()->previous())[0]!=route('orderindex'))
    		 	Session::put('orderPrevPage', route('orderindex'));
    		else
    			Session::put('orderPrevPage', url()->previous());
    	}

    	$order = order::with('client')->with('products')->find($id);
    	
	    if ($request->isMethod('post'))
	    {
	    	if($request->has('status'))
	    	{
	    		$order->status = $request->status;
	    		$order->update();
	    	}
	    }
	    return view('admin.order')
		    	->with('title', 'Заказ №'.$order->id.' от '.$order->created_at->format('d.m.Y h:m'))
                ->with($this->link)
		    	->with('order', $order);
    }
}
