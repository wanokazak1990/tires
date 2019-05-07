@extends ('layouts.admin')

@section('content')
	@if(isset($title))
		<div class="col-12">
			<h2>{{$title}}</h2>
		</div>
	@endif

	@if(isset($list))
		<div class="col-12 pt-3 pb-3">
			<a class="btn btn-warning" href="{{route('servicecreate')}}">
				Добавить
			</a>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table admin-editor">
			@foreach($list as $item)
				<tr class="col-4 p-0 content-item ">
					<td style="width: 200px;">
						@if($item->img)
							<img src="{{ $item->getUrlImg() }}">
						@endif
					</td>
					<td>
						<h4>{{$item->name}} ({{$item->alias}})</h4>
						<div style="height: 100px; overflow: hidden;">
							{!!$item->text!!}
						</div>						
					</td>
					<td class="{{($item->status)?'text-success':''}}" style="width: 50px" >
						<i class="icofont-power admin-icon"></i>
					</td>
					<td style="width: 50px;">
						<a href="{{route('serviceshow',['id'=>$item->id])}}">
							<i class="icofont-edit admin-icon"></i>
						</a>
					</td>
					<td style="width: 50px">
						<a class="content-del" data-id="{{$item->id}}" url="{{route('servicedelete')}}">
							<i class="icofont-bin admin-icon"></i>
						</a>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
		@else
			<div class="">Акций не найдено.</div>
		@endif
	@endif

	@if(isset($service) && !empty($service))
	<div class="admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container">
			<div class="row"> 
				<div class="col-md-6 col-sm-12">
					{{Form::label('title','Заголовок')}}
					{{Form::text('name',$service->name,['class'=>'form-control'])}}
					
					{{Form::label('title','Псевдоним(eng)')}}
					{{Form::text('alias',$service->alias,['class'=>'form-control'])}}					

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($service->status)?'true':'')}}
				</div>

				<div class="col-md-6 col-sm-12">
					{{Form::label('title','Фаил')}}
					@if(!empty($service->img))
						<img src="{{ $service->getUrlImg() }}">
					@endif
					<br>{{Form::file('img')}}
				</div>

				<div class="col-12">
					{{Form::label('title','Текст')}}
					{{Form::textarea('text',$service->text,['class'=>'form-control','id'=>'editor'])}}
				</div>	

				<div class="col-12">
					{{Form::submit('OK')}}
				</div>	
			</div>
		</div>
		
		{{Form::close()}}
		
	</div>
	@endif

@endsection