@extends ('layouts.admin')

@section('content')

	@if(isset($list))
		<div class="col-12 pt-3 pb-3">
			<a class="btn btn-warning" href="{{route('feedbackcreate')}}">
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
					<td>
						{{$item->text}}
					</td>
					<td class="{{($item->status)?'text-success':''}}" style="width: 50px" >
						<i class="icofont-power admin-icon"></i>
					</td>
					<td style="width: 50px;">
						<a href="{{route('feedbackshow',['id'=>$item->id])}}">
							<i class="icofont-edit admin-icon"></i>
						</a>
					</td>
					<td style="width: 50px">
						<a class="content-del" data-id="{{$item->id}}" url="{{route('feedbackdelete')}}">
							<i class="icofont-bin admin-icon"></i>
						</a>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
		@else
			<div class="">Отзывов не найдено.</div>
		@endif
	@endif

	@if(isset($feedback) && !empty($feedback))
	<div class="admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container">
			<div class="row"> 
				<div class="col-12">
					{{Form::label('title','Имя')}}
					{{Form::text('name',$feedback->name,['class'=>'form-control'])}}
				
					{{Form::label('title','Текст')}}
					{{Form::textarea('text',$feedback->text,['class'=>'form-control'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($feedback->status)?'true':'')}}
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