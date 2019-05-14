@extends('layouts.main')

@section('page')
<section class="container">

	@if(isset($page))
		<div class="row content-area">
			<div class="col-12">
				@if(isset($page->img))
					<img src="{{Image::url($page->img)}}" width="100%">
				@endif
				<h2>
					{{$page->title}}
				</h2>
				<p class="text-justify">
					{!! $page->text !!}
				</p>
			</div>
		</div>
	@endif

</section>

@endsection