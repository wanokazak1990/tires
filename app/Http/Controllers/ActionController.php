<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_action as action;

class ActionController extends Controller
{
	public $link = ['actionActive'=>'active'];

    public function index(Request $request)
    {
    	$actions = action::get();
    	return view('admin.action')
    	->with('list',$actions)
    	->with($this->link)
    	->with('title','Список акций');
    }

    public function create(Request $request)
    {
    	$action = new action();
    	return view('admin.action')
    	->with('title','Новая акция')
    	->with($this->link)
    	->with('action',$action)
    	->with('route',route('actionstore'));
    }

    public function store(Request $request)
    {
    	$path = $request->file('img')->store('public/actions');
    	$action = new action($request->all());
    	$action->img = $path;
    	$res = $action->save();
    	if($res)
    		return redirect()->route('actionindex');
    }

    public function show($id,Request $request)
    {
    	$action=action::find($id);
    	return view('admin.action')
    	->with('title','Редактировать акции')
    	->with('action',$action)
        ->with($this->link)
    	->with('route',route('actionupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$action = action::find($id);
        $action->status = 0;
    	$action->update($request->input());
    	if($request->file('img'))
    	{	
    		@unlink(storage_path('app/'.$action->img));
    		$action->img = $request->file('img')->store('public/actions');
    	}
    	$res = $action->save();
    	if($res)
    		return redirect()->route('actionindex');
    }

    public function destroy(Request $request)
    {
        $action = action::find($request->id);
        @unlink(storage_path('app/'.$action->img));
        echo $action->delete();
    }
}
