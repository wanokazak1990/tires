@extends ('layouts.admin')

@section('content')
	@if(isset($title))
		<div class="col-12 pt-3">
			<div class="h3">{{ $title }}</div>
		</div>
	@endif

	@if(isset($list))
		<div class="col-12 pt-3 pb-3">
			<div class="input-group no-gutters">
				<div class="col-sm-4 col-md-2">
					<a class="btn btn-outline-dark btn-block" href="{{route('servicecreate')}}">Добавить</a>
				</div>
			</div>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table table-hover table-bordered admin-editor">
				<thead class="thead-dark">
					<tr>
						<th>Изображение</th>
						<th>Содержимое страницы сервиса</th>
						<th>Статус</th>
						<th colspan="2">Редактирование</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr class="col-4 p-0 content-item ">
						<td style="width: 200px;">
							@if($item->img)
								<img src="{{ Image::url($item->img) }}">
							@endif
						</td>
						<td>
							<h4>{{$item->name}} ({{$item->alias}})</h4>
							<div style="height: 100px; overflow: hidden;">
								{!!$item->text!!}
							</div>						
						</td>
						<td class="{{($item->status)?'text-success':''}}" align="center" style="width: 50px" >
							<i class="icofont-power admin-icon"></i>
						</td>
						<td style="width: 50px;" align="center">
							<a href="{{route('serviceshow',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('servicedelete')}}">
								<i class="icofont-bin admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@else
			<div class="">Сервисов не найдено.</div>
		@endif
	@endif

	@if(isset($service) && !empty($service))
	<div class="admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container">
			<div class="row"> 
				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Заголовок')}}
					{{Form::text('name',$service->name,['class'=>'form-control mb-2'])}}
					
					{{Form::label('title','Псевдоним (eng)')}}
					{{Form::text('alias',$service->alias,['class'=>'form-control mb-2'])}}					

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($service->status)?'true':'')}}
				</div>

				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Изображение')}}
					@if(!empty($service->img))
						<img src="{{ Image::url($service->img) }}" class="mb-2">
					@endif
					<br>{{Form::file('img')}}<br/>

					{{Form::label('title','Иконка')}}
					@if(!empty($service->icon))
						<img src="{{ Image::url($service->icon) }}" class="mb-2" style="width: 150px; height: auto;">
					@endif
					<br>{{Form::file('icon')}}<br/>
				</div>

				<div class="col-12 mb-3">
					{{Form::label('title','Текст')}}
					{{Form::textarea('text',$service->text,['class'=>'form-control','id'=>'editor'])}}
				</div>	

				<div class="col-12 mb-3">
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