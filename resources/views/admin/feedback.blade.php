@extends ('layouts.admin')

@section('content')
	
	@if(isset($list))
		<div class="col-12 pt-3">
			<div class="h3">Отзывы</div>
		</div>
		<div class="col-12 pt-3 pb-3">
			<div class="input-group no-gutters">
				<div class="col-sm-4 col-md-2">
					<a class="btn btn-outline-dark btn-block" href="{{route('feedbackcreate')}}">Добавить</a>
				</div>
			</div>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table table-hover table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Имя клиента</th>
						<th>Текст отзыва</th>
						<th>Статус</th>
						<th colspan="2">Редактирование</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr class="col-4 p-0 content-item ">
						<td>
							{{$item->name}}
						</td>
						<td>
							{{$item->text}}
						</td>
						<td class="{{($item->status)?'text-success':''}}" align="center" style="width: 50px" >
							<i class="icofont-power admin-icon"></i>
						</td>
						<td style="width: 50px;" align="center">
							<a href="{{route('feedbackshow',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('feedbackdelete')}}">
								<i class="icofont-bin admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@else
			<div class="">Отзывов не найдено.</div>
		@endif
	@endif

	@if(isset($feedback) && !empty($feedback))
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>

	<div class="col-12 admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<!-- <div class="container"> -->
			<div class="row"> 
				<div class="col-6">
					{{Form::label('title','Имя клиента')}}
					{{Form::text('name',$feedback->name,['class'=>'form-control mb-3'])}}
				
					{{Form::label('title','Текст отзыва')}}
					{{Form::textarea('text',$feedback->text,['class'=>'form-control mb-3'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($feedback->status)?'true':'')}}
				</div>

				<div class="col-6">
					{{Form::label('title','Изображение')}}
					@if(!empty($feedback->img))
						<img src="{{ Image::url($feedback->img) }}">
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
		<!-- </div> -->
		{{Form::close()}}
		
	</div>
	@endif

@endsection