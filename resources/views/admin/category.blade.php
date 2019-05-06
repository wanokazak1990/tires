@extends ('layouts.admin')

@section('content')

	@if(isset($list))
	<div class="container">
		<div class="col-12 pt-3 pb-3">
			<a class="btn btn-warning" href="{{route('catcreate')}}">
				Добавить
			</a>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table">
			@foreach($list as $item)
				<tr class="col-4 p-0 content-item ">
					<td>
						{{$item->name}}
					</td>
					<td class="{{($item->status)?'text-success':''}}" style="width: 50px" >
						<i class="icofont-power admin-icon"></i>
					</td>
					<td style="width: 50px;">
						<a href="{{route('catshow',['id'=>$item->id])}}">
							<i class="icofont-edit admin-icon"></i>
						</a>
					</td>
					<td style="width: 50px">
						<a class="content-del" data-id="{{$item->id}}" url="{{route('catdelete')}}">
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
	</div>
	@endif

	@if(isset($category) && !empty($category))
	<div class="container admin-editor" >
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="row"> 
			<div class="col-6">
				{{Form::label('title','Имя')}}
				{{Form::text('name',$category->name,['class'=>'form-control'])}}

				{{Form::label('title','Статус')}}
				{{Form::checkbox('status',1,($category->status)?'true':'')}}
			</div>

			<div class="col-12">
				{{Form::submit('OK')}}
			</div>	
		</div>
		{{Form::close()}}
		
	</div>
	@endif

@endsection