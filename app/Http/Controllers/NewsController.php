<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_new as news;
use Image;

class NewsController extends Controller
{
    public $link = ['newslistActive'=>'active'];

    public function index()
    {
    	return view('admin.newlist')
        	->with('title', 'Список новостей')
            ->with($this->link)
        	->with('list', news::orderBy('id','DESC')->paginate(env('PAGINATE')));
    }

    public function create()
    {
    	$new = new news();
    	return view('admin.newlist')
    	->with('title', 'Добавить новость')
    	->with('new', $new)
        ->with($this->link)
    	->with('route', route('newstore'));
    }

    public function store(Request $request)
    {
        $new = new news($request->all());
        if($request->file('img'))
        {
        	$path = $request->file('img')->store('public/news');
            $image = Image::editImgByWidth($path,1100);    	
        	$new->img = $path;
    	}
        $res = $new->save();
    	if($res)
    		return redirect()->route('newlist');
    }

    public function show($id)
    {
    	$new=news::find($id);
    	return view('admin.newlist')
    	->with('title', 'Редактировать новость')
    	->with('new', $new)
        ->with($this->link)
    	->with('route', route('newupdate',['id'=>$id]));
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
            $image = Image::editImgByWidth($new->img,1100);
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
