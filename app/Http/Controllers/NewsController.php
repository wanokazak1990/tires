<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_new as news;

class NewsController extends Controller
{
    public function index()
    {
    	return view('admin.newlist')
        	->with('title','Список новостей')
            ->with('newslistActive', 'active')
        	->with('list',news::orderBy('id','DESC')->paginate(env('PAGINATE')));
    }

    public function create()
    {
    	$new = new news();
    	return view('admin.newlist')
    	->with('title','Добавить новость')
    	->with('new',$new)
    	->with('route',route('newstore'));
    }

    public function store(Request $request)
    {
    	$path = $request->file('img')->store('public/news');
    	$new = new news($request->all());
    	$new->img = $path;
    	$res = $new->save();
    	if($res)
    		return redirect()->route('newlist');
    }

    public function show($id)
    {
    	$new=news::find($id);
    	return view('admin.newlist')
    	->with('title','Редактировать новость')
    	->with('new',$new)
    	->with('route',route('newupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$new = news::find($id);
        $new->status = 0;
    	$new->update($request->input());
    	if($request->file('img'))
    	{	
    		@unlink(storage_path('app/'.$new->img));
    		$new->img = $request->file('img')->store('public/news');
    	}
    	$res = $new->save();
    	if($res)
    		return redirect()->route('newlist');
    }

    public function destroy(Request $request)
    {
        $new = news::find($request->id);
        @unlink(storage_path('app/'.$new->img));
        echo $new->delete();
    }
}
