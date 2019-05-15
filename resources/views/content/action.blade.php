@extends('layouts.main')

@section('products')
<section class="container">
	
	@if(isset($list))
		<div class="row content-area">
			<div class="col-12">
				<h2 class="area-title">{{$title}}</h2>
			</div>
		</div>
		<div class="row">
		@foreach($list as $item)
		
			<div class="col-12 col-sm-12 col-md-6 mb-4">
				<div style="position: relative;">
					<h2 style="padding:0 15px;position: absolute;top: 15px; left: 0px; background: rgba(255,255,255,0.5);width: 100%;">{{$item->name}}</h2>
					<img src="{{Image::url($item->img)}}" style="width: 100%;height: auto;">
					<div class="text-right" style="position: absolute;bottom: 15px; right: 15px;">
						<a href="{{route('actionitem',['id'=>$item->id])}}" class="btn btn-warning">
							Подробнее
						</a>
					</div>
				</div>
			</div>
		
		@endforeach
		</div>
	@endif

	@if(isset($action))
		<div class="row content-area pb-4">
			<div class="col-12">
				<img src="{{Image::url($action->img)}}" class="area-img">

				<h2 class="area-title">
					{{$action->name}}
				</h2>
				<div>
					{!!$action->text!!}
				</div>
				<div class="text-right pt-3" >
					<a href="{{url()->previous()}}" class="btn btn-warning">
						Назад
					</a>
				</div>
			</div>
		</div>
	@endif

</section>

@endsection