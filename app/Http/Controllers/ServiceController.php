<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_service as service;

class ServiceController extends Controller
{
    public $link = ['serviceActive'=>'active'];

    public function index(Request $request)
    {
    	$services = service::get();
    	return view('admin.service')
    	->with('list',$services)
    	->with($this->link)
    	->with('title','Список страниц сервиса');
    }

    public function create(Request $request)
    {
    	$service = new service();
    	return view('admin.service')
    	->with('title','Новая страницы сервиса')
    	->with($this->link)
    	->with('service',$service)
    	->with('route',route('servicestore'));
    }

    public function store(Request $request)
    {
    	$path = $request->file('img')->store('public/services');
    	$service = new service($request->all());
    	$service->img = $path;
    	$res = $service->save();
    	if($res)
    		return redirect()->route('serviceindex');
    }

    public function show($id,Request $request)
    {
    	$service=service::find($id);
    	return view('admin.service')
    	->with('title','Редактировать страницу сервиса')
    	->with('service',$service)
    	->with('route',route('serviceupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$service = service::find($id);
        $service->status = 0;
    	$service->update($request->input());
    	if($request->file('img'))
    	{	
    		@unlink(storage_path('app/'.$service->img));
    		$service->img = $request->file('img')->store('public/services');
    	}
    	$res = $service->save();
    	if($res)
    		return redirect()->route('serviceindex');
    }

    public function destroy(Request $request)
    {
        $service = service::find($request->id);
        @unlink(storage_path('app/'.$service->img));
        echo $service->delete();
    }
}
