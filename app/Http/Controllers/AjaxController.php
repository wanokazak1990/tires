<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_product as product;
use App\hm_category as category;
use App\hm_attribute as attribute;
use App\hm_car_filter as filter;

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
}
