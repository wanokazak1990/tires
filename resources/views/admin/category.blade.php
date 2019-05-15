@extends ('layouts.admin')

@section('content')
	
	@if(isset($list))
		<div class="col-12 pt-3">
			<div class="h3">Категории</div>
		</div>
		<div class="col-12 pt-3 pb-3">
			<div class="input-group no-gutters">
				<div class="col-sm-4 col-md-2">
					<a class="btn btn-outline-dark btn-block" href="{{route('catcreate')}}">Добавить</a>
				</div>
			</div>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table table-hover table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Название категории</th>
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
						<td class="{{($item->status)?'text-success':''}}" align="center" style="width: 50px" >
							<i class="icofont-power admin-icon"></i>
						</td>
						<td style="width: 50px;" align="center">
							<a href="{{route('catshow',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('catdelete')}}">
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

	@if(isset($category) && !empty($category))
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>
	<div class="col-12 admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		
			<div class="row"> 
				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Имя')}}
					{{Form::text('name',$category->name,['class'=>'form-control mb-2'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($category->status)?'true':'')}}
				</div>

				<div class="col-12 mb-3">
					<div class="input-group no-gutters">
						<div class="col-md-2 col-sm-12">
							{{Form::submit('Применить', ['class'=>'btn btn-success btn-block'])}}
						</div>
					</div>
				</div>	
			</div>
		
		{{Form::close()}}
		
	</div>
	@endif

@endsection