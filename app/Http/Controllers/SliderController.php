<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\my_slider as slider;
use Storage;
use Image;
use Messandger;

class SliderController extends Controller
{
    public $link = ['sliderlistActive'=>'active'];

    public function index()
    {
    	return view('admin.sliderlist')
        	->with('title','Список слайдов')
        	->with('list',slider::get())
            ->with($this->link);
    }

    public function create()
    {
    	$slider = new slider();
    	return view('admin.sliderlist')
    	->with('title','Добавить слайд')
    	->with('slider',$slider)
        ->with($this->link)
    	->with('route',route('sliderstore'));
    }

    public function store(Request $request)
    {
    	$path = $request->file('img')->store('public/sliders');
        $image = Image::editImgByWidth($path,1920);
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
        ->with($this->link)
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
            $image = Image::editImgByWidth($slider->img,1920);
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
