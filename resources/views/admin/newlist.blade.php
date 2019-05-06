@extends ('layouts.admin')

@section('content')

	@if(isset($list))
	<div class="container">
		<div class="col-12 pt-3 pb-3">
			<a class="btn btn-warning" href="{{route('newcreate')}}">
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
						<h4>{{$item->title}}</h4>
						<div>{!! $item->text !!}</div>
					<td>
						{{$item->alias}}
					</td>
					<td class="{{($item->status)?'text-success':''}}" style="width: 50px" >
						<i class="icofont-power admin-icon"></i>
					</td>
					<td style="width: 50px;">
						<a href="{{route('newshow',['id'=>$item->id])}}">
							<i class="icofont-edit admin-icon"></i>
						</a>
					</td>
					<td style="width: 50px">
						<a class="content-del" data-id="{{$item->id}}" url="{{route('newdelete')}}">
							<i class="icofont-bin admin-icon"></i>
						</a>
					</td>
				</tr>
			@endforeach
			</table>
			{{$list->links()}}
		</div>
		@else
			<div class="">Вы ещё не создали ни одного слайда.</div>
		@endif
	</div>
	@endif

	@if(isset($new) && !empty($new))
	<div class="container admin-editor" >
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="row"> 
			<div class="col-6">
				{{Form::label('title','Заголовок')}}
				{{Form::text('title',$new->title,['class'=>'form-control'])}}
				
				{{Form::label('title','Псевдоним(eng)')}}
				{{Form::text('alias',$new->alias,['class'=>'form-control'])}}

				{{Form::label('title','Текст')}}
				{{Form::textarea('text',$new->text,['class'=>'form-control'])}}

				{{Form::label('title','Статус')}}
				{{Form::checkbox('status',1,($new->status)?'true':'')}}
			</div>

			<div class="col-6">
				{{Form::label('title','Фаил')}}
				@if(!empty($new->img))
					<img src="{{ $new->getUrlImg() }}">
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