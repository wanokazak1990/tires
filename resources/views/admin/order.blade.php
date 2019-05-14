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
						<th>№ </th>
						<th>Дата создания</th>
						<th>Дата изменения</th>
						<th>Клиент заказа</th>
						<th>Сумма заказа</th>
						<th>Статус заказа</th>
						<th>Тип трафика</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr class="col-4 p-0 content-item ">
						<td>
							{{str_pad($item->id,5,'0',STR_PAD_LEFT)}}
						</td>
						<td class="text-center">
							<div>{{$item->created_at->format('d.m.Y')}}</div>
							<div>{{$item->created_at->format('h:m')}}</div>
						</td>
						<td class="text-center">
							<div>{{$item->updated_at->format('d.m.Y')}}</div>
							<div>{{$item->updated_at->format('h:m')}}</div>
						</td>
						<td style="width: 270px;">
							@if(!empty($item->client))
								<div><b>Имя:</b> {{$item->client->name}}</div>
								<div><b>Тел:</b> {{$item->client->phone}}</div>
								<div><b>Email:</b> {{$item->client->mail}}</div>
							@endif
						</td>
						<td>
							{{$item->orderTotalPrice('money')}} руб.
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
			<div class="row"> 
				<div class="col-12 pt-3 pb-3">
					<h5>Статус заказа: {{$order->getStatus()}}</h5>
					<h5>Трафик заказа: {{$order->getType()}}</h5>
				</div>

				<div class="col-4" >
					<h4>Клиент</h4>
					@if(!empty($order->client))
						<table class="table">
							<tr>
								<td>
									Имя: 
								</td>
								<td>
									{{$order->client->name}}
								</td>
							</tr>
							<tr>
								<td>
									Телефон: 
								</td>
								<td>
									{{$order->client->phone}}
								</td>
							</tr>
							<tr>
								<td>
									Email: 
								</td>
								<td>
									{{$order->client->mail}}
								</td>
							</tr>
						</table>
					@endif
				</div>	
				<div class="col-8">
					<h4>Продукты</h4>
					@if(!empty($order->products))
						<table class="table"> 
						@foreach($order->products as $sale)
							<tr>
								<td>
									<img src="{{$sale->originalProduct->getUrlImg()}}" style="width: 100px;height: auto;">
								</td>
								<td>
									<h4>{{$sale->originalProduct->name}}</h4>
									<div>Артикул: {{$sale->originalProduct->article}}</div>
									<div>Текущая цена: {{number_format($sale->originalProduct->price,0,'',' ')}} руб.</div>
								</td>
								<td>
									<h4>Заказ</h4>
									<div>Количество: {{$sale->count}}</div>
									<div>Цена (момент заказа): {{number_format($sale->saleprice,0,'',' ')}} руб.</div>
									<div>Цена (итого): {{number_format($sale->count*$sale->saleprice,0,'',' ')}} руб.</div>
								</td>
							</tr>
						@endforeach
							<tr>
								<td colspan="3" class="text-right">
									<h4>
										Итого 
										{{$order->orderTotalPrice('money')}}
										руб.
									</h4>
								</td>
							</tr>
						</table>

						<div class="col-12">
							{{Form::select('status',$order->statusArr(),$order->status,['class'=>'form-control'])}}
						</div>
						
					@endif
				</div>
			</div>

			<div class="input-group no-gutters d-flex justify-content-between">
				<div class="col-3">
					{{Form::submit('Применить изменения', ['class'=>'btn btn-success btn-block mt-3'])}}
				</div>
				<div class="col-2">
					<a href="{{Session::get('orderPrevPage')}}" class="btn btn-danger btn-block mt-3">Назад</a>
				</div>
			</div>

		{{Form::close()}}		
	</div>
	@endif

@endsection