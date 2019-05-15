@extends('layouts.main')

@section('products')
<section class="container">

	@if(isset($service))
		<div class="row itemnews">
			<div class="col-12">
				@if(isset($service->img))
					<img src="{{Image::url($service->img)}}">
				@endif
				<h2>
					{{$service->name}}
				</h2>
				<p class="text-justify">
					{!!$service->text!!}
				</p>
			</div>
		</div>
	@endif

</section>

@endsection