<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_page;

class PageController extends Controller
{
	public $link = ['pagesActive'=>'active'];

    public function index(Request $request)
    {
    	return view('admin.pages')
    	->with($this->link)
    	->with('pagesList', hm_page::get())
    	->with('title','Страницы сайта');
    }

    public function add(Request $request)
    {
    	$page = new hm_page();

    	return view('admin.pages')
    	->with('page', $page)
    	->with('route',route('pageput'))
    	->with('title','Добавить страницу');
    }

    public function put(Request $request)
    {
    	$page = new hm_page($request->all());

    	if ($request->has('img'))
    	{
    		$path = $request->file('img')->store('public/pages');
    		$page->img = $path;
    	}
    	
    	$result = $page->save();
    	
    	if ($result)
    		return redirect()->route('pageindex');
    }

    public function edit(Request $request, $id)
    {
    	$page = hm_page::find($id);

    	return view('admin.pages')
    	->with('page', $page)
    	->with('route',route('pageupdate',['id'=>$id]))
    	->with('title','Добавить страницу');
    }

    public function update(Request $request, $id)
    {
    	$page = hm_page::find($id);
        $page->status = 0;
    	$page->update($request->input());

    	if($request->file('img'))
    	{	
    		@unlink(storage_path('app/'.$page->img));
    		$page->img = $request->file('img')->store('public/pages');
    	}

    	$result = $page->save();
    	
    	if ($result)
    		return redirect()->route('pageindex');
    }

    public function destroy(Request $request)
    {
    	$page = hm_page::find($request->id);
        @unlink(storage_path('app/'.$page->img));
        echo $page->delete();
    }
}
