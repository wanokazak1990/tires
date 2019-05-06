@extends ('layouts.admin')

@section('content')

	@if(isset($list))
		<div class="col-12 pt-3 pb-3">
			<a class="btn btn-warning" href="{{route('attrcreate')}}">
				Добавить
			</a>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table">
			@foreach($list as $item)
				<tr class="col-4 p-0 content-item ">
					<td style="white-space: nowrap;">
						{{$item->name}}
					</td>
					<td style="font-size: 12px;">
						@if(isset($item->values))
							@foreach($item->values as $key=>$val)
								{{$val->value}}
								{{($key<$item->values->count()-1)?"|":""}}
							@endforeach	
						@endif
					</td>
					<td>
						@if(isset($item->category))
							{{$item->category->name}}
						@endif
					</td>
					<td class="{{($item->status)?'text-success':''}}" style="width: 50px" >
						<i class="icofont-power admin-icon"></i>
					</td>
					<td style="width: 50px;">
						<a href="{{route('attrshow',['id'=>$item->id])}}">
							<i class="icofont-edit admin-icon"></i>
						</a>
					</td>
					<td style="width: 50px">
						<a class="content-del" data-id="{{$item->id}}" url="{{route('attrdelete')}}">
							<i class="icofont-bin admin-icon"></i>
						</a>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
		@else
			<div class="">Вы ещё не создали ни одного слайда.</div>
		@endif
	@endif

	@if(isset($attribute) && !empty($attribute))
	<div class="admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container">
			<div class="row"> 
				<div class="col-md-6 col-sm-12">
					{{Form::label('title','Имя')}}
					{{Form::text('name',$attribute->name,['class'=>'form-control'])}}

					{{Form::label('category_id','Категория')}}
					{{Form::select('category_id',$category,$attribute->category_id,['class'=>'form-control'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($attribute->status)?'true':'')}}
				</div>

				<div class="col-md-6 col-sm-12">
					{{Form::label('title','Допустимые значения')}}

					@if(isset($attribute->values))
						<div class="col-12">
						@foreach($attribute->values as $val)
							
								<div class="preinstall value-wrapper row" data-id="{{$val->id}}"> 
									{{Form::text(
										'p_values[]',
										$val->value,
										['class'=>'form-control col-4','data-id'=>$val->id]
									)}}
									<div class="col-1">
										{{Form::checkbox('p_status[]',1,($val->status)?'true':''),['data-id'=>$val->id]}}
									</div> 
								</div>
							
						@endforeach
					@endif

								<div class="value-wrapper row"> 
									{{Form::text(
										'p_values[]',
										'',
										['class'=>'form-control col-4']
									)}}
									<div class="col-1">
										{{Form::checkbox('p_status[]',1)}}
									</div> 
									<div class="col-3">
										<button type="button" class="add-value btn btn-success">
											Добавить
										</button>
									</div>
									<div class="col-3">
										<button type="button" class="del-value btn btn-danger">
											Удалить
										</button>
									</div>
								</div>
						</div>
				</div>

				<div class="col-12">
					{{Form::button('OK',['type'=>'button','class'=>'btn btn-warning','id'=>'submit-attr'])}}
				</div>	
			</div>
		</div>
		{{Form::close()}}
		
	</div>
	@endif

@endsection