<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_product as product;
use App\hm_category as category;
use App\hm_attribute as attribute;
use App\hm_car_filter as filter;
use App\hm_order as order;
use App\hm_service_client as serviceClient;

use Messandger;

class AjaxController extends Controller
{
    public function product(Request $request)
    {
    	if($request->has('id') && $request->id)
    	{
    		$product = product::with('attributes')->find($request->id);
            $product->img = $product->getUrlImg();
    		echo $product->toJson();
    		return;
    	}
    }

    public function attributes(Request $request)
    {
    	if($request->has('category_id'))
    	{
    		$attributes = attribute::with('values')->where('category_id',$request->category_id)->get();
    		echo $attributes->toJson();
    		return;
    	}
    }

    public function filter(Request $request)
    {
        $mas = ['vendor','car','year','modification'];

        $filter = filter::select('vendor','car','year','modification');

        if($request->has('vendor') && !empty($request->vendor))
            $filter->where('vendor',$request->vendor);
        if($request->has('car') && !empty($request->car))
            $filter->where('car',$request->car);
        if($request->has('year') && !empty($request->year))
            $filter->where('year',$request->year);

        $index = 0;
        foreach ($request->all() as $key => $value) 
        {
            if($value && in_array($key, $mas))
            {
                $index = array_search($key, $mas);
            }
        }
        
        if($index || $index==0)
        {   
            $filter->groupBy($mas[$index+1]);
        }

        $list = $filter->get()->toJson();
        echo $list;

        return;
    }

    public function recordService(Request $request)
    {
        $serviceClient = new serviceClient();

        $serviceClient->name = $request->name;
        $serviceClient->phone = str_replace(array(' ', '(', ')', '-'), '', $request->phone);
        $serviceClient->date = strtotime($request->date);
        $serviceClient->time = strtotime($request->time);
        $serviceClient->comment = $request->comment;

        Messandger::serviceMsg($request->all());
        
        if ($serviceClient->save())
            echo '1';
        else
            echo '0';        
    }

    public function showProfit(Request $request)
    {
        $orders = order::with('client')->with('products')
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->datefrom)))
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->dateto)))
            ->where('status', 3)
            ->get();

        if (count($orders) > 0)
        {
            $profit = 0;

            foreach ($orders as $o_key => $order) 
            {
                foreach ($order->products as $p_key => $product) 
                {
                    $profit += $product->count * $product->saleprice;
                }
            }

            echo '<div class="h5">Прибыль за указанный период составила <span class="text-success">'.$profit.'</span> рублей.</div>';
        }
        else
        {
            echo '<div class="h5">За указанный период прибыли получено не было.</div>';
        }
    }
}
