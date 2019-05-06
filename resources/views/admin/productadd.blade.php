@extends('layouts.admin')

@section('content')
	@if(isset($product))
		<div class="container admin-editor" >
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="row">
			<div class="col-8">
				<div class="row">
					<div class="col-6"> 
						{{Form::label('article','Артикул')}}
						{{Form::text('article',$product->article,['class'=>'form-control'])}}

						{{Form::label('name','Название')}}
						{{Form::text('name',$product->name,['class'=>'form-control'])}}
						

						{{Form::label('price','Цена')}}
						{{Form::text('price',$product->price,['class'=>'form-control'])}}

						{{Form::label('available','Кол-во на складе')}}
						{{Form::text('available',$product->available,['class'=>'form-control'])}}

						{{Form::label('title','Статус')}}
						{{Form::checkbox('status',1,($product->status)?'true':'')}}
					</div>
					<div class="col-6">
						{{Form::label('category_id','Категория')}}
						{{Form::select('category_id',App\hm_category::pluck('name','id'),$product->category_id,['class'=>'form-control product-category','url'=>route('ajaxattr')])}}

						{{Form::label('title','Параметры')}}
						<div class="parameters">
							@if(isset($product->attributes) && ($product->attributes->count()>0))
								<table>
								@foreach($product->attributes as $item)
									<tr>
										<td>{{@$item->attrName->name}}</td>
										<td>
											@if(isset($item->parameters))
											<select name="attr[{{$item->attribute_id}}]">
												@foreach($item->parameters as $val)
													<option value="{{$val->id}}" {{($item->value_id==$val->id)?"selected":""}}>{{$val->value}}</option>
												@endforeach
											</select>
											@endif
										</td>
									</tr>
								@endforeach
								</table>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						{{Form::label('title','Описание')}}
						{{Form::textarea('description',$product->description,['class'=>'form-control'])}}
					</div>
				</div>
			</div>

			<div class="col-4">
				{{Form::label('title','Фаил')}}
				@if(!empty($product->img))
					<img src="{{ $product->getUrlImg() }}">
				@endif
				<br>{{Form::file('img')}}
			</div>

			<div class="col-12">
				{{Form::submit('OK')}}
			</div>
		</div>
		{{Form::close()}}
		</div>
	@endif
@endsection