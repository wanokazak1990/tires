@extends('layouts.main')

@section('products')
<section class="container">
	
	@if(isset($list))
		<h2>{{$title}}</h2>
		@foreach($list as $item)
		<div class="row pb-4 pt-4">
			<div class="col-12 col-sm-12 col-md-6">
				<div style="position: relative;">
					<h2 style="padding:0 15px;position: absolute;top: 15px; left: 0px; background: rgba(255,255,255,0.5);width: 100%;">{{$item->name}}</h2>
					<img src="{{$item->getUrlImg()}}" style="width: 100%;height: auto;">
					<div class="text-right" style="position: absolute;bottom: 15px; right: 15px;">
						<a href="{{route('actionitem',['id'=>$item->id])}}" class="btn btn-warning">
							Подробнее
						</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	@endif

	@if(isset($action))
		<div class="row content-area pb-4">
			<div class="col-12">
				<img src="{{$action->getUrlImg()}}" style="padding-bottom: 15px;width: 100%;height: auto;">

				<h2>
					{{$action->name}}
				</h2>
				<p class="text-justify">
					{!!$action->text!!}
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