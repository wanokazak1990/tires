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

			{{Form::hidden('_method','get')}}
		<div class="row">
			<div class="col-4">
				<div>
					{{Form::label('article','Артикул')}}
					{{Form::text('article',@$filter['article'],['class'=>'form-control'])}}
				</div>

				<div>
					{{Form::label('name','Название')}}
					{{Form::text('name',@$filter['name'],['class'=>'form-control'])}}
				</div>

				<div>
					{{Form::label('pricefrom','Цена от')}}
					{{Form::text('pricefrom',@$filter['pricefrom'],['class'=>'form-control'])}}
				</div>

				<div>
					{{Form::label('priceto','Цена до')}}
					{{Form::text('priceto',@$filter['priceto'],['class'=>'form-control'])}}
				</div>
			</div>

			<div class="col-4">
				<div>
					{{Form::label('status','Статус')}}
					{{Form::select('status',['null'=>'Любой',0=>'Не активно',1=>'Активно'],@$filter['status'],['class'=>'form-control'])}}
				</div>

				<div>
					{{Form::label('countfrom','Кол-во от')}}
					{{Form::text('countfrom',@$filter['countfrom'],['class'=>'form-control'])}}
				</div>

				<div>
					{{Form::label('countto','Кол-во до')}}
					{{Form::text('countto',@$filter['countto'],['class'=>'form-control'])}}
				</div>

				<div>
					{{Form::label('category_id','Категория')}}
					{{Form::select('category_id',App\hm_category::getAllToSelect(),@$filter['category_id'],['class'=>'form-control'])}}
				</div>
			</div>

			<div class="product-attr col-4">
				@foreach(App\hm_attribute::get() as $attr)
				<div style="
				{{@($attr->category_id == $filter['category_id'])?'':'display: none'}}
				">
					<div>
					{{Form::label('sel',$attr->name)}}
					</div>
					<select class="form-control" {{@($attr->category_id == $filter['category_id'])?'':'disabled'}} name="attribute[{{$attr->id}}]" data-category="{{$attr->category_id}}" >
						<option value="0">Не выбрано</option>
						@foreach(App\hm_attribute_value::where('attribute_id',$attr->id)->get() as $val)
						<option value="{{$val->id}}" {{@(in_array($val->id,$filter['attribute']))?'selected':''}}>
							{{$val->value}}
						</option>
						@endforeach
					</select>
				</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-12 text-right">
				<a class="btn btn-warning" href=" {{ route('productexport',$filter) }} ">Экспорт Excel</a> 
				{{Form::submit('Поиск',['class'=>'btn btn-success mt-3 mb-3'])}}
				<button type="submit" name="clear" class="btn btn-danger mb-3 mt-3">Отмена</button>
			</div>
		</div>
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
			{{$list->appends($filter)->links()}}
		</div>
	</div>
	@endif
@endsection