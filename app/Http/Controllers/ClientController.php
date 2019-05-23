<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_client as client;

class ClientController extends Controller
{
    public $link = ['clientActive'=>'active'];

    public function index(Request $request)
    {
    	$filter = array();
    	
    	$clients = client::with('order');

        if(!$request->has('cancel'))
    	{
    		if ($request->has('name') && $request->name != null)
    			$clients = $clients->where('name', 'like', '%'.$request->name.'%');

    		if ($request->has('phone') && $request->phone != null)
    			$clients = $clients->where('phone', 'like', '%'.$request->phone.'%');

    		if ($request->has('mail') && $request->mail != null)
    			$clients = $clients->where('mail', 'like', '%'.$request->mail.'%');

    		$filter = $request->all();
            unset($filter['_method']);
            unset($filter['_token']);
    	}

    	
    	$clients = $clients->orderBy('id', 'desc')->paginate(env('PAGINATE'));

    	return view('admin.client')
    		->with('title', 'Список клиентов')
    		->with($this->link)
    		->with('list', $clients)
    		->with('filter', $filter);
    }

    public function edit(Request $request)
    {
    	$client = client::find($request->id);

    	return view('admin.client')
    		->with('title', 'Редактирование клиента')
    		->with($this->link)
    		->with('client', $client);
    }

    public function update(Request $request, $id)
    {
    	$client = client::find($id);
    	$client->update($request->input());
    	return redirect()->route('clientindex');
    }
}
