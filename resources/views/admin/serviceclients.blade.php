@extends ('layouts.admin')

@section('content')
	@if(isset($title))
		<div class="col-12 pt-3">
			<div class="h3">{{ $title }}</div>
		</div>
	@endif

	@if(isset($list))
		@if(count($list)) 
		<div class="col-12">
			<table class="table table-hover table-bordered admin-editor">
				<thead class="thead-dark">
					<tr>
						<th>Имя клиента</th>
						<th>Телефон</th>
						<th>Дата</th>
						<th>Время</th>
						<th>Комментарий</th>
						<th>Удалить</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr class="col-4 p-0 content-item ">
						<td>
							{{ $item->name }}
						</td>
						<td>
							{{ $item->phone }}					
						</td>
						<td>
							{{ date('d.m.Y', $item->date) }}					
						</td>
						<td>
							{{ date('H:i', $item->time) }}
						</td>
						<td>
							{{ $item->comment }}					
						</td>
						<td style="width: 50px" align="center">
							<a class="content-del" data-id="{{$item->id}}" url="{{route('serviceclientdelete')}}">
								<i class="icofont-bin admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@else
			<div class="">Записей не найдено.</div>
		@endif
	@endif

@endsection