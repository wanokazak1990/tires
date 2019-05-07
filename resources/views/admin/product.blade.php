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