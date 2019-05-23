<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SiteInfo;
use App\hm_info;
use App\visit;
use Image;

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

    	$info->fill($request->all());

    	if ($request->has('logo'))
    	{
    		$logo_path = $request->file('logo')->store('public/settings');
    		$info->logo = $logo_path;
            $image = Image::editImgByWidth($info->logo,300);
    	}    	

    	if ($request->has('title_icon'))
    	{
    		$title_icon_path = $request->file('title_icon')->store('public/settings');
    		$info->title_icon = $title_icon_path;
            $image = Image::editImgByWidth($info->title_icon,300);
    	}

        if ($request->has('og_image'))
        {
            $title_icon_path = $request->file('og_image')->store('public/settings');
            $info->og_image = $title_icon_path;
            $image = Image::editImgByWidth($info->og_image,700);
        }

    	$result = $info->save();
        
    	if ($result)
    		return redirect()->route('infoindex');
    }
}
