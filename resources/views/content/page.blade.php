@extends('layouts.main')

@section('page')
<section class="container">

	@if(isset($page))
		<div class="row content-area">
			<div class="col-12">
				@if(isset($page->img))
					<img src="{{Image::url($page->img)}}" class="area-img">
				@endif
				<h2 class="area-title">
					{{$page->title}}
				</h2>
				<div>
					{!! $page->text !!}
				</div>
			</div>
		</div>
	@endif

</section>

@endsection