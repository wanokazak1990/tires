<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_attribute as attribute;
use App\hm_category as category;
use App\hm_attribute_value as value;

class AttributeController extends Controller
{
    public $link = ['attributeActive'=>'active'];

    public function index()
    {
    	return view('admin.attribute')
        	->with('title', 'Список атрибутов')
            ->with($this->link)
        	->with('list', attribute::with('category')->with('values')->orderBy('category_id')->get());
    }

    public function create()
    {
    	$attr = new attribute();
    	$category = category::pluck('name','id');
    	return view('admin.attribute')
    	->with('title', 'Добавить атрибут')
    	->with('attribute', $attr)
    	->with('category', $category)
        ->with($this->link)
    	->with('route', route('attrstore'));
    }

    public function store(Request $request)
    {
    	$data = array();
    	$values = array();

    	$data = $request->all();
    	if(isset($data['values'])){
    		$values = $data['values'];
    		unset($data['values']);
    	}

    	$attr_id = attribute::create($data);

    	foreach ($values as $key => $value) {
    		$value = new value($value);
    		$value->attribute_id = $attr_id->id;
    		$value->save();
    	}
    	
    	echo route('attrlist');
    }

    public function show($id)
    {
    	$attribute=attribute::with('values')->find($id);
    	$category = category::pluck('name','id');
    	return view('admin.attribute')
    	->with('title', 'Редактировать атрибут')
    	->with('attribute', $attribute)
    	->with('category', $category)
        ->with($this->link)
    	->with('route', route('attrupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$data = array();
    	$values = array();

    	$data = $request->all();
    	if(isset($data['values'])){
    		$values = $data['values'];
    		unset($data['values']);
    	}

    	$attribute = attribute::find($id);
    	$attribute->update($data);

    	value::where('attribute_id',$attribute->id)->delete();
    	foreach ($values as $key => $value) {
    		$attrVal= new value($value);
    		$attrVal->attribute_id = $attribute->id;
    		$attrVal->id = $value['id'];
    		$attrVal->save();
    	}
    	//dump($values);
    	echo route('attrlist');
    }

    public function destroy(Request $request)
    {
        $category = category::find($request->id);
        echo $category->delete();
    }
}
