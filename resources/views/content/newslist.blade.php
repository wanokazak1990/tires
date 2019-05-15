@extends('layouts.main')

@section('products')
<section class="container">
	
	@if(isset($list))
		@foreach($list as $item)
		<div class="row newslist">
			<div class="col-4">
				<img src="{{Image::url($item->img)}}">
			</div>
			<div class="col-8">
				<h2>{{$item->title}}</h2>
				<p class="text-justify">{!!mb_strimwidth($item->text,0,420,'...')!!}</p>
				<div class="text-right">
					<a href="{{route('itemnew',['id'=>$item->id])}}" class="btn btn-warning">
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
				<img src="{{Image::url($new->img)}}" style="padding-bottom: 15px;">

				<h2>
					{{$new->title}}
				</h2>
				<p class="text-justify">
					{!!$new->text!!}
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