@extends('layouts.main')

@section('products')
<section class="container">
	
	@if(isset($list))
		<div class="row content-area">
			<div class="col-12">
				<h2 class="area-title">{{$title}}</h2>
			</div>
		</div>
		@foreach($list as $item)
		<div class="row newslist" style="height: 200px;overflow: hidden;">
			<div class="col-4">
				<div style="height: 200px;background: url('{{Image::url($item->img)}}'); background-position: center;background-size: cover;"></div>
			</div>
			<div class="col-8" style="height: 200px;overflow: hidden;">
				<h2>{{$item->title}}</h2>
				<div >{!!mb_strimwidth($item->text,0,700,'...')!!}</div>
				<div class="text-right" style="position: absolute;bottom: 0px;right: 0px;background: linear-gradient(to top,#fff,rgba(0,0,0,0));padding: 15px;width: 100%;height: 100px;">
					<a href="{{route('itemnew',['id'=>$item->id])}}" class="btn btn-warning" style="position: absolute;bottom: 15px;right: 15px;">
						Подробнее
					</a>
				</div>
			</div>
		</div>
		@endforeach
		<div class="row">
			{{$list->links()}}
		</div>
	@endif

	@if(isset($new))
		<div class="row content-area pb-4">
			<div class="col-12">
				<img src="{{Image::url($new->img)}}" class="area-img">

				<h2 class="area-title">
					{{$new->title}}
				</h2>
				<div>
					{!!$new->text!!}
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