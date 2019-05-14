<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['info','visit']], function() {
	Route::get('/', 'ContentController@index')->name('main');
	Route::match(['get', 'post'],'/content/product','ContentController@productlist')->name('productlist');
	Route::post('/content/search','ContentController@search')->name('search');
	Route::get('/content/searchresult','ContentController@searchresult')->name('searchresult');
	Route::get('/formatfilter','ContentController@formatfilter');
	Route::get('/newslist','ContentController@siteList')->name('newslist');
	Route::get('/itemnew/{id}','ContentController@siteItem')->name('itemnew');
	Route::get('/actionlist','ContentController@actionList')->name('actionlist');
	Route::get('/actionitem/{id}','ContentController@actionItem')->name('actionitem');
	Route::get('/services/{alias}','ContentController@services')->name('services');
	Route::get('/pages/{alias}','ContentController@pages')->name('pages');
	Route::get('/contacts','ContentController@contacts')->name('contacts');
});

Auth::routes();

Route::get('/home', function(){
	return redirect()->route('main');
});

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
	
	Route::get('/','AdminController@index')->name('admin');

	Route::group(['prefix'=>'sliders'],function(){
		Route::get('/','SliderController@index')			->name('sliderlist');
		Route::get('/create','SliderController@create')		->name('slidercreate');
		Route::post('/','SliderController@store')			->name('sliderstore');
		Route::get('/{id}/edit','SliderController@show')	->name('slidershow');
		Route::post('/{id}','SliderController@update')		->name('sliderupdate');
		Route::delete('/','SliderController@destroy')		->name('sliderdelete');
	});

	Route::group(['prefix'=>'feedbacks'],function(){
		Route::get('/','FeedbackController@index')			->name('feedbacklist');
		Route::get('/create','FeedbackController@create')		->name('feedbackcreate');
		Route::post('/','FeedbackController@store')			->name('feedbackstore');
		Route::get('/{id}/edit','FeedbackController@show')	->name('feedbackshow');
		Route::post('/{id}','FeedbackController@update')		->name('feedbackupdate');
		Route::delete('/','FeedbackController@destroy')		->name('feedbackdelete');
	});

	Route::group(['prefix'=>'news'],function(){
		Route::get('/','NewsController@index')			->name('newlist');
		Route::get('/create','NewsController@create')	->name('newcreate');
		Route::post('/','NewsController@store')			->name('newstore');
		Route::get('/{id}/edit','NewsController@show')	->name('newshow');
		Route::post('/{id}','NewsController@update')	->name('newupdate');
		Route::delete('/','NewsController@destroy')		->name('newdelete');
	});

	Route::group(['prefix'=>'categories'],function(){
		Route::get('/','CategoryController@index')			->name('catlist');
		Route::get('/create','CategoryController@create')	->name('catcreate');
		Route::post('/','CategoryController@store')			->name('catstore');
		Route::get('/{id}/edit','CategoryController@show')	->name('catshow');
		Route::post('/{id}','CategoryController@update')	->name('catupdate');
		Route::delete('/','CategoryController@destroy')		->name('catdelete');
	});

	Route::group(['prefix'=>'attributes'],function(){
		Route::get('/','AttributeController@index')			->name('attrlist');
		Route::get('/create','AttributeController@create')	->name('attrcreate');
		Route::post('/','AttributeController@store')			->name('attrstore');
		Route::get('/{id}/edit','AttributeController@show')	->name('attrshow');
		Route::post('/{id}','AttributeController@update')	->name('attrupdate');
		Route::delete('/','AttributeController@destroy')		->name('attrdelete');
	});

	Route::group(['prefix'=>'product'],function(){
		Route::get('/','ProductController@index')			->name('tovarlist');
		Route::get('/create','ProductController@create')	->name('tovarcreate');
		Route::post('/','ProductController@store')			->name('tovarstore');
		Route::get('/{id}/edit','ProductController@show')	->name('tovarshow');
		Route::post('/{id}','ProductController@update')		->name('tovarupdate');
		Route::delete('/','ProductController@destroy')		->name('tovardelete');
	});

	Route::group(['prefix'=>'action'],function(){
		Route::get('/','ActionController@index')->name('actionindex');
		Route::get('/create','ActionController@create')->name('actioncreate');
		Route::post('/create','ActionController@store')->name('actionstore');
		Route::get('/edit/{id}','ActionController@show')->name('actionshow');
		Route::post('/edit/{id}','ActionController@update')->name('actionupdate');
		Route::delete('/','ActionController@destroy')->name('actiondelete');
	});

	Route::group(['prefix'=>'services'],function(){
		Route::get('/','ServiceController@index')->name('serviceindex');
		Route::get('/create','ServiceController@create')->name('servicecreate');
		Route::post('/create','ServiceController@store')->name('servicestore');
		Route::get('/edit/{id}','ServiceController@show')->name('serviceshow');
		Route::post('/edit/{id}','ServiceController@update')->name('serviceupdate');
		Route::delete('/','ServiceController@destroy')->name('servicedelete');
	});

	Route::group(['prefix'=>'info'],function(){
		Route::get('/','InfoController@index')->name('infoindex');
		Route::get('/edit','InfoController@edit')->name('infoedit');
		Route::post('/edit','InfoController@update')->name('infoupdate');
	});

	Route::group(['prefix'=>'pages'],function(){
		Route::get('/', 'PageController@index')->name('pageindex');
		Route::get('/add', 'PageController@add')->name('pageadd');
		Route::post('/add','PageController@put')->name('pageput');
		Route::get('/{id}/edit','PageController@edit')->name('pageedit');
		Route::post('/{id}','PageController@update')->name('pageupdate');
		Route::delete('/','PageController@destroy')->name('pagedelete');
	});

	Route::group(['prefix'=>'orders'],function(){
		Route::get('/','OrderController@index')->name('orderindex');
		Route::match(['get','post'],'/{id}','OrderController@show')->name('ordershow');
	});

});

Route::group(['prefix'=>'ajax'],function(){
	Route::post('/product','AjaxController@product')->name('ajaxproduct');
	Route::post('/attributes','AjaxController@attributes')->name('ajaxattr');
	Route::post('/filter','AjaxController@filter')->name('filter');
});

Route::group(['prefix'=>'cart','middleware'=>'cart'],function(){
	Route::post('/add','CartController@append')->name('cartadd');
	Route::post('/take','CartController@take')->name('carttake');
	Route::post('/remove','CartController@remove')->name('cartremove');
	Route::post('/','CartController@show')->name('cartshow');
	Route::post('/cartindikator','CartController@cartIndikator')->name('cartindikator');
	Route::post('/order','CartController@order')->name('order');
});
