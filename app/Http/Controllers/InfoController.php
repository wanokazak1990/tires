<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SiteInfo;
use App\hm_info;
use App\visit;

class InfoController extends Controller
{
    public $link = ['infoActive'=>'active'];

    public function index(Request $request)
    {
    	$info = hm_info::first();
        $visits = visit::limit(3)->orderBy('id','desc')->get();
        $totalVisit = visit::sum('count');
    	return view('admin.info')
    	->with('info', $info)
        ->with($this->link)
        ->with('visits',$visits)
        ->with('totalVisit',$totalVisit)
    	->with('title','Основные настройки');
    }

    public function edit(Request $request)
    {
    	$info = hm_info::first();

    	return view('admin.infoedit')
    	->with('info', $info)
    	->with($this->link)
    	->with('route', route('infoupdate'))
    	->with('title','Редактирование настроек');
    }

    public function update(Request $request)
    {
    	$info = hm_info::first();
    	$info->name = $request->name;
    	$info->slogan = $request->slogan;
    	$info->phone = $request->phone;
    	$info->address = $request->address;
    	$info->hours = $request->hours;
    	$info->weekend = $request->weekend;
    	$info->description = $request->description;
    	$info->admin_email = $request->admin_email;
    	$info->vk_group = $request->vk_group;

    	if ($request->has('logo'))
    	{
    		$logo_path = $request->file('logo')->store('public/settings');
    		$info->logo = $logo_path;
    	}    	

    	if ($request->has('title_icon'))
    	{
    		$title_icon_path = $request->file('title_icon')->store('public/settings');
    		$info->title_icon = $title_icon_path;
    	}

    	$info->map_code = $request->map_code;
    	$info->metrics_code = $request->metrics_code;
    	$result = $info->save();

    	if ($result)
    		return redirect()->route('infoindex');
    }
}
