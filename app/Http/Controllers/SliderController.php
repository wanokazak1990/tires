<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\my_slider as slider;
use Storage;


class SliderController extends Controller
{
    public function index()
    {
    	return view('admin.sliderlist')
        	->with('title','Список слайдов')
        	->with('list',slider::get());
    }

    public function create()
    {
    	$slider = new slider();
    	return view('admin.sliderlist')
    	->with('title','Новый слайд')
    	->with('slider',$slider)
    	->with('route',route('sliderstore'));
    }

    public function store(Request $request)
    {
    	$path = $request->file('img')->store('public/sliders');
    	$slider = new slider($request->all());
    	$slider->img = $path;
    	$res = $slider->save();
    	if($res)
    		return redirect()->route('sliderlist');
    }

    public function show($id)
    {
    	$slider=slider::find($id);
    	return view('admin.sliderlist')
    	->with('title','Редактировать слайд')
    	->with('slider',$slider)
    	->with('route',route('sliderupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$slider = slider::find($id);
        $slider->status = 0;
    	$slider->update($request->input());
    	if($request->file('img'))
    	{	
    		@unlink(storage_path('app/'.$slider->img));
    		$slider->img = $request->file('img')->store('public/sliders');
    	}
    	$res = $slider->save();
    	if($res)
    		return redirect()->route('sliderlist');
    }

    public function destroy(Request $request)
    {
        $slider = slider::find($request->id);
        @unlink(storage_path('app/'.$slider->img));
        echo $slider->delete();
    }

}
