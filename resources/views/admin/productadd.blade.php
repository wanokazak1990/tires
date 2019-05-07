@extends('layouts.admin')

@section('content')
	@if(isset($product))
		<div class="col-12 pt-3">
			<div class="h3">{{ $title }}</div>
		</div>
		<div class="admin-editor">
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					<div class="row">
						<div class="col-md-6 col-sm-12"> 
							{{Form::label('article','Артикул')}}
							{{Form::text('article',$product->article,['class'=>'form-control mb-2'])}}

							{{Form::label('name','Название')}}
							{{Form::text('name',$product->name,['class'=>'form-control mb-2'])}}
							

							{{Form::label('price','Цена')}}
							{{Form::text('price',$product->price,['class'=>'form-control mb-2'])}}

							{{Form::label('available','Кол-во на складе')}}
							{{Form::text('available',$product->available,['class'=>'form-control mb-2'])}}

							{{Form::label('title','Статус')}}
							{{Form::checkbox('status',1,($product->status)?'true':'')}}
						</div>
						<div class="col-md-6 col-sm-12">
							{{Form::label('category_id','Категория')}}
							{{Form::select('category_id',App\hm_category::pluck('name','id'),$product->category_id,['class'=>'form-control product-category mb-2','url'=>route('ajaxattr')])}}

							{{Form::label('title','Параметры')}}
							<div class="parameters">
								@if(isset($product->attributes) && ($product->attributes->count()>0))
									<table style="width: 100%;">
									@foreach($product->attributes as $item)
										<tr>
											<td>{{@$item->attrName->name}}</td>
											<td>
												@if(isset($item->parameters))
												<select name="attr[{{$item->attribute_id}}]" class="form-control">
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
							{{Form::textarea('description',$product->description,['class'=>'form-control mb-2'])}}
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-12 mb-3">
					{{Form::label('title','Изображение')}}
					@if(!empty($product->img))
						<img src="{{ $product->getUrlImg() }}" class="mb-2">
					@endif
					<br>{{Form::file('img')}}
				</div>

				<div class="col-12">
					<div class="input-group no-gutters">
						<div class="col-md-2 col-sm-12">
							{{Form::submit('Применить', ['class'=>'btn btn-success btn-block'])}}
						</div>
					</div>
				</div>
			</div>
		</div>
		{{Form::close()}}
		</div>
	@endif
@endsection