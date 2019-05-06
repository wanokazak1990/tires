@extends('layouts.main')

@section('products')
<section class="container">
	
	@if(isset($list))
		<h2>{{$title}}</h2>
		@foreach($list as $item)
		<div class="row newslist">
			<div class="col-4">
				<img src="{{$item->getUrlImg()}}">
			</div>
			<div class="col-8">
				<h2>{{$item->name}}</h2>
				<p class="text-justify">{{($item->text)}}</p>
				<div class="text-right">
					<a href="{{route('actionitem',['id'=>$item->id])}}" class="btn btn-warning">
						Подробнее
					</a>
				</div>
			</div>
		</div>
		@endforeach
	@endif

	@if(isset($action))
		<div class="row itemnews">
			<div class="col-12">
				<img src="{{$action->getUrlImg()}}" style="float: left;padding-right: 15px;padding-bottom: 15px;">

				<h2>
					{{$action->name}}
				</h2>
				<p class="text-justify">
					{{$action->text}}
				</p>
				<div class="text-right" >
					<a href="{{url()->previous()}}" class="btn btn-warning">
						Назад
					</a>
				</div>
			</div>
		</div>
	@endif

</section>

@endsection