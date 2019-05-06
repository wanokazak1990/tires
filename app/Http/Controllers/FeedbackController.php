<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hm_feedback as feedback;

class FeedbackController extends Controller
{
    public function index()
    {
    	return view('admin.feedback')
        	->with('title','Список отзывов')
        	->with('list',feedback::get())
            ->with('feedbackActive', 'active');
    }

    public function create()
    {
    	$feedback = new feedback();
    	return view('admin.feedback')
    	->with('title','Новый отзыв')
    	->with('feedback',$feedback)
    	->with('route',route('feedbackstore'));
    }

    public function store(Request $request)
    {
    	$feedback = new feedback($request->all());
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
    	->with('route',route('feedbackupdate',['id'=>$id]));
    }

    public function update($id,Request $request)
    {
    	$feedback = feedback::find($id);
        $feedback->status = 0;
    	$feedback->update($request->input());
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
