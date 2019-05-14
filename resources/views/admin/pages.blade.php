@extends ('layouts.admin')

@section('content')

	@isset($title)
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>
	@endisset

	@if(isset($pagesList))
	<div class="col-12 py-3">
		<div class="input-group no-gutters">
			<div class="col-sm-4 col-md-2">
				<a class="btn btn-outline-dark btn-block" href="{{route('pageadd')}}">Добавить</a>
			</div>
		</div>
	</div>

	<div class="col-12">
		@if(count($pagesList))
			<style>
				img{max-width: 100%;}
			</style>
			<table class="table table-hover table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>Изображение</th>
						<th>Содержимое страницы</th>
						<th>Псевдоним</th>
						<th>Статус</th>
						<th colspan="2">Редактирование</th>
					</tr>
				</thead>
				<tbody>
				@foreach($pagesList as $item)
					<tr class="col-4 p-0 content-item">
						<td style="width: 200px;" align="center">
							@if($item->img)
								<img src="{{ $item->getUrlImg() }}" width="200px">
							@else
								Нет изображения
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
							<a href="{{route('pageedit',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('pagedelete')}}">
								<i class="icofont-bin admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@else
			<div class="">Страниц не найдено.</div>
		@endif
	</div>
	

	@elseif(isset($page))
	<div class="col-12">
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="input-group no-gutters">
			<div class="col-md-6 col-sm-12 mb-3">
				{{Form::label('title','Заголовок:')}}
				{{Form::text('title',$page->title,['class'=>'form-control mb-2'])}}
				
				{{Form::label('alias','Псевдоним (eng):')}}
				{{Form::text('alias',$page->alias,['class'=>'form-control mb-2'])}}

				{{Form::label('text','Текст:')}}
				{{Form::textarea('text',$page->text,['class'=>'form-control mb-2', 'id'=>'editor'])}}

				{{Form::label('status','Статус:')}}
				{{Form::checkbox('status',1,($page->status)?'true':'')}}
			</div>

			<div class="col-md-6 col-sm-12 mb-3">
				{{Form::label('title','Изображение')}}
				@if(!empty($page->img))
					<img src="{{ $page->getUrlImg() }}" width="100%">
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
		{{Form::close()}}
	</div>
	@endif

@endsection