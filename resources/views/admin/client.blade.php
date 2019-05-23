@extends ('layouts.admin')

@section('content')
	@if(isset($title))
		<div class="col-12 pt-3">
			<div class="h3">{{ $title }}</div>
		</div>
	@endif

	@if(isset($list))
		<div class="col-12 mb-3 search_product">
			<div>Поиск по фильтрам:</div>
			{{ Form::open(array('url' => route('clientindex'))) }}
			{{Form::hidden('_method','get')}}
			<div class="row mb-3">
				<div class="col-4">
					<label>Имя:</label>
					<input type="text" name="name" class="form-control" value="{{ $filter['name'] or '' }}">
				</div>

				<div class="col-4">
					<label>Телефон:</label>
					<input type="text" name="phone" class="form-control" value="{{ $filter['phone'] or '' }}">			
				</div>

				<div class="col-4">
					<label>Email:</label>
					<input type="text" name="mail" class="form-control" value="{{ $filter['mail'] or '' }}">
				</div>
			</div>

			<div class="input-group no-gutters d-flex justify-content-end">
				<div class="col-2">
					<button type="submit" class="btn btn-success btn-block">Поиск</button>
				</div>
				<div class="col-2">
					<button type="submit" name="cancel" class="btn btn-danger btn-block">Отмена</button>
				</div>
			</div>
			{{ Form::close() }}
		</div>
		

		@if(count($list))
		<div class="col-12">
			<table class="table table-hover table-bordered admin-editor">
				<thead class="thead-dark">
					<tr>
						<th>Имя</th>
						<th>Телефон</th>
						<th>Email</th>
						<th>Показать заказы</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr>
						<td>
							{{ $item->name }}
						</td>
						<td>
							{{ $item->phone }}
						</td>
						<td>
							{{ $item->mail }}
						</td>
						<td style="width: 50px" align="center">
							<a href="{{route('orderindex',['phone'=>$item->phone])}}" target="_blank">
								<i class="icofont-list admin-icon"></i>
							</a>
						</td>
						<td style="width: 50px" align="center">
							<a href="{{route('clientedit',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

			<div class="paginate">
				{{ $list->links() }}
			</div>
		</div>
		@else
			<div class="col-12">Клиентов не найдено.</div>
		@endif
	@endif

	@isset($client)
		<div class="col-12">
			{{ Form::open(array('url' => route('clientupdate', ['id'=>$client->id]) )) }}

			<div class="row mb-3">
				<div class="col-4">
					<label>Имя:</label>
					<input type="text" name="name" class="form-control" value="{{ $client->name }}">
				</div>

				<div class="col-4">
					<label>Телефон:</label>
					<input type="text" name="phone" class="form-control" value="{{ $client->phone }}">
				</div>

				<div class="col-4">
					<label>Email:</label>
					<input type="text" name="mail" class="form-control" value="{{ $client->mail }}">
				</div>
			</div>

			<div class="input-group no-gutters justify-content-end mb-3">
				<div class="col-2">
					<input type="submit" class="btn btn-success btn-block" value="Сохранить">
				</div>
				<div class="col-2">
					<a href="{{ route('clientindex') }}" class="btn btn-danger btn-block">Отмена</a> 
				</div>
			</div>

			{{ Form::close() }}
		</div>
	@endisset

@endsection