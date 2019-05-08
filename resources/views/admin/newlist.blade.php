@extends ('layouts.admin')

@section('content')
	
	@if(isset($list))
		<div class="col-12 pt-3">
			<div class="h3">Новости</div>
		</div>
		<div class="col-12 py-3">
			<div class="input-group no-gutters">
				<div class="col-sm-4 col-md-2">
					<a class="btn btn-outline-dark btn-block" href="{{route('newcreate')}}">Добавить</a>
				</div>
			</div>
		</div>
		@if(count($list)) 
		<div class="col-12">
			<table class="table table-hover table-bordered admin-editor">
				<thead class="thead-dark">
					<tr>
						<th>Изображение</th>
						<th>Содержимое новости</th>
						<th>Псевдоним</th>
						<th>Статус</th>
						<th colspan="2">Редактирование</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr class="col-4 p-0 content-item ">
						<td style="width: 200px;">
							@if($item->img)
								<img src="{{ $item->getUrlImg() }}">
							@endif
						</td>
						<td>
							<h4>{{$item->title}}</h4>
							<div>{!! substr(substr($item->text, 0, 300), 0, strrpos(substr($item->text, 0, 300), ' ')) !!}...</div>
						</td>
						<td align="center">
							{{$item->alias}}
						</td>
						<td class="{{($item->status)?'text-success':''}}" align="center" style="width: 50px" >
							<i class="icofont-power admin-icon"></i>
						</td>
						<td style="width: 50px;" align="center">
							<a href="{{route('newshow',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('newdelete')}}">
								<i class="icofont-bin admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			{{$list->links()}}
		</div>
		@else
			<div class="">Новостей не найдено.</div>
		@endif
	@endif

	@if(isset($new) && !empty($new))
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>
	<div class="admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container">
			<div class="row"> 
				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Заголовок')}}
					{{Form::text('title',$new->title,['class'=>'form-control mb-2'])}}
					
					{{Form::label('title','Псевдоним (eng)')}}
					{{Form::text('alias',$new->alias,['class'=>'form-control mb-2'])}}

					{{Form::label('title','Текст')}}
					{{Form::textarea('text',$new->text,['class'=>'form-control mb-2'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($new->status)?'true':'')}}
				</div>

				<div class="col-md-6 col-sm-12 mb-3">
					{{Form::label('title','Изображение')}}
					@if(!empty($new->img))
						<img src="{{ $new->getUrlImg() }}">
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