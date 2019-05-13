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
						<th>№ заказа</th>
						<th>Дата создания</th>
						<th>Дата изменения</th>
						<th>Клиент заказа</th>
						<th>Статус заказа</th>
						<th>Тип трафика</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr class="col-4 p-0 content-item ">
						<td>{{$item->id}}</td>
						<td class="text-center">
							<div>{{$item->created_at->format('d.m.Y')}}</div>
							<div>{{$item->created_at->format('h:m')}}</div>
						</td>
						<td class="text-center">
							<div>{{$item->updated_at->format('d.m.Y')}}</div>
							<div>{{$item->updated_at->format('h:m')}}</div>
						</td>
						<td>
							@if(!empty($item->client))
								<div><b>Имя:</b> {{$item->client->name}}</div>
								<div><b>Тел:</b> {{$item->client->phone}}</div>
								<div><b>Email:</b> {{$item->client->mail}}</div>
							@endif
						</td>
						<td>{{$item->getStatus()}}</td>
						<td>{{$item->getType()}}</td>
						<td>
							<a href="{{route('ordershow',['id'=>$item->id])}}">
								<i class="icofont-edit admin-icon"></i>
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

			<div class="paginate">
				{{$list->links()}}
			</div>
		</div>
		@else
			<div class="">Заказов не найдено.</div>
		@endif
	@endif

	@if(isset($order) && !empty($order))
	<div class="admin-editor container">
		
		{{Form::open(array('files'=>'true','url'=>route('ordershow',['id'=>$order->id])))}}
		
			<div class="row" > 
				<div class="col-4" >
					<h4>Клиент</h4>
					@if(!empty($order->client))
						<div>
							Имя: {{$order->client->name}}
						</div>
						<div>
							Телефон: {{$order->client->name}}
						</div>
						<div>
							Email: {{$order->client->name}}
						</div>
					@endif
				</div>	
				<div class="col-8">
					<h4>Продукты</h4>
					@if(!empty($order->products))
						@foreach($order->products as $sale)
							<div>
								{{$sale->product_id}}<br/>
								{{$sale->count}}<br/>
								{{$sale->saleprice}}<br/>
								{{$sale->saleprice*$sale->count}}<br/>
								{{$sale->originalProduct->name}}
							</div>
						@endforeach
					@endif
				</div>
			</div>

		{{Form::close()}}
		
	</div>
	@endif

@endsection