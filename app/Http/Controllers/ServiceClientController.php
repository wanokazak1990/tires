<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_service_client;

class ServiceClientController extends Controller
{
    public $link = ['serviceClientActive'=>'active'];

    public function index(Request $request)
    {
    	$list = hm_service_client::orderBy('id', 'desc')->get();

    	return view('admin.serviceclients')
	    	->with('list', $list)
	    	->with($this->link)
	    	->with('title', 'Записи на сервис');
    }

    public function destroy(Request $request)
    {
        $service = hm_service_client::find($request->id);
        echo $service->delete();
    }
}
