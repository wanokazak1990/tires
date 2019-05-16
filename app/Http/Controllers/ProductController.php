<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_product as product;
use App\hm_attribute as attribute;
use App\hm_product_attribute as pattribute;

class ProductController extends Controller
{
    public $link = ['productActive'=>'active'];

    public function index(Request $request)
    {
        if($request->isMethod('get'))
    	   $list = product::with('category')->with('attributes')->orderBy('category_id','DESC')->paginate(env('PAGINATE'));
        else
        {
            $query = product::select('hm_products.*');

            if($request->has('article') && !empty($request->article))
                $query->where('article',trim($request->article));
            
            if($request->has('name') && !empty($request->name))
                $query->where('name',trim($request->name));

            if($request->has('pricefrom') && !empty($request->pricefrom) && is_numeric($request->pricefrom))
                $query->where('price','>=',$request->pricefrom);

            if($request->has('priceto') && !empty($request->priceto) && is_numeric($request->priceto))
                $query->where('price','<=',$request->priceto);

            if($request->has('countfrom') && !empty($request->countfrom) && is_numeric($request->countfrom))
                $query->where('available','>=',$request->countfrom);

            if($request->has('countto') && !empty($request->countto) && is_numeric($request->countto))
                $query->where('available','<=',$request->countto);

            if($request->has('status') && $request->status!=='null')
                $query->where('status','=',$request->status);

            if($request->has('category_id') && $request->category_id!=='null')
                $query->where('category_id','=',$request->category_id);

            
            $list = $query->with('category')->with('attributes')->paginate(env('PAGINATE'));
        }
    	
    	return view('admin.product')
        	->with('title', 'Список продуктов')
            ->with($this->link)
        	->with('list', $list);
    }

    public function create()
    {
    	$product = new product();
    	return view('admin.productadd')
    	->with('title', 'Добавить продукт')
    	->with('product', $product)
        ->with($this->link)
    	->with('route', route('tovarstore'));
    }

    public function store(Request $request)
    {
    	$path = $request->file('img')->store('public/products');
    	$product = new product($request->all());
    	$product->img = $path;
    	$res = $product->save();
    	if($res && $request->has('attr'))
    	{
    		foreach ($request->attr as $key => $value) {
    			pattribute::create([
    				'product_id'=>$product->id,
    				'attribute_id'=>$key,
    				'value_id'=>$value
    			]);
    		}
    	}
    	return redirect()->route('tovarlist');
    }

    public function show($id)
    {
    	$product=product::with('attributes')->find($id);
    	return view('admin.productadd')
    	->with('title', 'Редактировать продукт')
    	->with('product', $product)
        ->with($this->link)
    	->with('route', route('tovarupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$product = product::find($id);
    	$product->fill($request->input());
    	if($request->file('img'))
    	{	
    		@unlink(storage_path('app/'.$product->img));
    		$product->img = $request->file('img')->store('public/products');
    	}
    	$res = $product->save();
    	if($res && $request->has('attr'))
    	{
    		pattribute::where('product_id',$id)->delete();
    		foreach ($request->attr as $key => $value) {
    			pattribute::create([
    				'product_id'=>$product->id,
    				'attribute_id'=>$key,
    				'value_id'=>$value
    			]);
    		}
    	}
    	return redirect()->route('tovarlist');
    }

    public function destroy(Request $request)
    {
        $product = product::find($request->id);
        @unlink(storage_path('app/'.$new->img));
        pattribute::where('product_id',$request->id)->delete();
        echo $new->delete();
    }
}
