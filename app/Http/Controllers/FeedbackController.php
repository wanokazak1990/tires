<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_feedback as feedback;
use Image;
use Storage;

class FeedbackController extends Controller
{
    public $link = ['feedbackActive'=>'active'];

    public function index()
    {
    	return view('admin.feedback')
        	->with('title','Список отзывов')
        	->with('list',feedback::get())
            ->with($this->link);
    }

    public function create()
    {
    	$feedback = new feedback();
    	return view('admin.feedback')
    	->with('title','Добавить отзыв')
    	->with('feedback',$feedback)
        ->with($this->link)
    	->with('route',route('feedbackstore'));
    }

    public function store(Request $request)
    {
        $path = $request->file('img')->store('public/feedbacks');
        
        $image = Image::editImgByWidth($path,300);
        
        $feedback = new feedback($request->all());
        $feedback->img = $path;
    	$res = $feedback->save();
    	if($res)
    		return redirect()->route('feedbacklist');
    }

    public function show($id)
    {
    	$feedback=feedback::find($id);
    	return view('admin.feedback')
    	->with('title','Редактировать отзыв')
    	->with('feedback',$feedback)
        ->with($this->link)
    	->with('route',route('feedbackupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$feedback = feedback::find($id);
        $feedback->status = 0;
    	$feedback->fill($request->input());
        if($request->file('img'))
        {   
            @unlink(storage_path('app/'.$feedback->img));
            $feedback->img = $request->file('img')->store('public/feedbacks');
            $image = Image::editImgByWidth($feedback->img,300);
        }
    	$res = $feedback->save();
    	if($res)
    		return redirect()->route('feedbacklist');
    }

    public function destroy(Request $request)
    {
        $feedback = feedback::find($request->id);
        echo $feedback->delete();
    }
}
