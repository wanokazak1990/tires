@extends ('layouts.admin')

@section('content')
	<div class="col-12 pt-3">
		<div class="h3">Продукты</div>
	</div>
	<div class="col-12 pt-3 pb-3">
		<div class="input-group no-gutters">
			<div class="col-sm-4 col-md-2">
				<a class="btn btn-outline-dark btn-block" href="{{route('tovarcreate')}}">Добавить</a>
			</div>
		</div>
	</div>

		<div class="col-12 search_product">
		{{Form::open(array('url'=>route('tovarlist')))}}

			<div>
				{{Form::label('article','Артикул')}}
				{{Form::text('article','')}}
			</div>

			<div>
				{{Form::label('name','Название')}}
				{{Form::text('name','')}}
			</div>

			<div>
				{{Form::label('pricefrom','Цена от')}}
				{{Form::text('pricefrom','')}}
			</div>

			<div>
				{{Form::label('priceto','Цена до')}}
				{{Form::text('priceto','')}}
			</div>

			<div>
				{{Form::label('status','Статус')}}
				{{Form::select('status',['null'=>'Любой',0=>'Не активно',1=>'Активно'])}}
			</div>

			<div>
				{{Form::label('countfrom','Кол-во от')}}
				{{Form::text('countfrom','')}}
			</div>

			<div>
				{{Form::label('countto','Кол-во до')}}
				{{Form::text('countto','')}}
			</div>

			<div id="category_id">
				{{Form::label('category_id','Категория')}}
				{{Form::select('category_id',App\hm_category::getAllToSelect(),'')}}
			</div>

			<div class="product-attr">

			</div>

			{{Form::submit('Поиск')}}

		{{Form::close()}}
	</div>

	@if(isset($list) && is_object($list) && count($list)>0)

	<div class="col-12">
		<table class="table table-hover table-bordered product-stock">
			<thead class="thead-dark">
				<tr>
					<th>Артикул</th>
					<th>Название</th>
					<th>Изображение</th>
					<th>Атрибуты</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Статус</th>
					<th>Редактирование</th>
				</tr>
			</thead>
			<tbody>
			@foreach($list as $item)
				@include('admin.productcell')
			@endforeach
			</tbody>
		</table>
		<div class="col-12"> 
			{{$list->links()}}
		</div>
	</div>
	@endif
@endsection