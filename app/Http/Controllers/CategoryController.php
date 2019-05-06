<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_category as category;

class CategoryController extends Controller
{
    public function index()
    {
    	return view('admin.category')
        	->with('title','Список категорий')
        	->with('list',category::get());
    }

    public function create()
    {
    	$category = new category();
    	return view('admin.category')
    	->with('title','Новая категория')
    	->with('category',$category)
    	->with('route',route('catstore'));
    }

    public function store(Request $request)
    {
    	$category = new category($request->all());
    	$res = $category->save();
    	if($res)
    		return redirect()->route('catlist');
    }

    public function show($id)
    {
    	$category=category::find($id);
    	return view('admin.category')
    	->with('title','Редактировать категорию')
    	->with('category',$category)
    	->with('route',route('catupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$category = category::find($id);
        $category->status = 0;
    	$category->update($request->input());
    	$res = $category->save();
    	if($res)
    		return redirect()->route('catlist');
    }

    public function destroy(Request $request)
    {
        $category = category::find($request->id);
        echo $category->delete();
    }
}
