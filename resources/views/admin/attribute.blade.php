@extends ('layouts.admin')

@section('content')
	
	@if(isset($list))
		<div class="col-12 pt-3">
			<div class="h3">Атрибуты</div>
		</div>
		<div class="col-12 pt-3 pb-3">
			<div class="input-group no-gutters">
				<div class="col-sm-4 col-md-2">
					<a class="btn btn-outline-dark btn-block" href="{{route('attrcreate')}}">Добавить</a>
				</div>
			</div>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table table-hover table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Название</th>
						<th>Допустимые значения</th>
						<th>Категория</th>
						<th>Статус</th>
						<th colspan="2">Редактирование</th>
					</tr>
				</thead>
				<tbody>
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
						<td class="{{($item->status)?'text-success':''}}" align="center" style="width: 50px" >
							<i class="icofont-power admin-icon"></i>
						</td>
						<td style="width: 50px;" align="center">
							<a href="{{route('attrshow',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('attrdelete')}}">
								<i class="icofont-bin admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@else
			<div class="">Вы ещё не создали ни одного слайда.</div>
		@endif
	@endif

	@if(isset($attribute) && !empty($attribute))
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>
	<div class="col-12 admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		
			<div class="row"> 
				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Имя')}}
					{{Form::text('name',$attribute->name,['class'=>'form-control mb-2'])}}

					{{Form::label('category_id','Категория')}}
					{{Form::select('category_id',$category,$attribute->category_id,['class'=>'form-control mb-2'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($attribute->status)?'true':'')}}
				</div>

				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Допустимые значения')}}

					@if(isset($attribute->values))
					<div class="input-group no-gutters">
						<div class="col-12">
							@foreach($attribute->values as $val)
							<div class="preinstall value-wrapper input-group no-gutters" data-id="{{$val->id}}"> 
								{{Form::text(
									'p_values[]',
									$val->value,
									['class'=>'form-control col-3','data-id'=>$val->id]
								)}}
								<div class="col-1 d-flex align-items-center justify-content-center">
									{{Form::checkbox('p_status[]',1,($val->status)?'true':''),['data-id'=>$val->id]}}
								</div> 
							</div>
							@endforeach
						@endif
							<div class="value-wrapper input-group no-gutters"> 
								{{Form::text(
									'p_values[]',
									'',
									['class'=>'form-control col-3']
								)}}
								<div class="col-1 d-flex align-items-center justify-content-center">
									{{Form::checkbox('p_status[]',1)}}
								</div> 
								<div class="col-4">
									<button type="button" class="add-value btn btn-info btn-block">
										Добавить
									</button>
								</div>
								<div class="col-4">
									<button type="button" class="del-value btn btn-danger btn-block">
										Удалить
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="input-group no-gutters">
						<div class="col-md-2 col-sm-12">
							{{Form::button('Применить',['type'=>'button','class'=>'btn btn-success btn-block','id'=>'submit-attr'])}}
						</div>
					</div>
				</div>	
			</div>
		
		{{Form::close()}}
		
	</div>
	@endif

@endsection