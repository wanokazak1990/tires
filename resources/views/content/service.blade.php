@extends('layouts.main')

@section('products')
<section class="container">

	@if(isset($service))
		<div class="row content-area pb-4">
			<div class="col-12">
				@if(isset($service->img))
					<img src="{{Image::url($service->img)}}" class="area-img">
				@endif
				<h2 class="area-title">
					{{$service->name}}
				</h2>
				<div>
					{!!$service->text!!}
				</div>
			</div>
		</div>
	@endif

</section>

@endsection