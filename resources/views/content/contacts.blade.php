@extends('layouts.main')

@section('contacts')
<section class="container">

	@if(isset($info))
		<div class="row">
			<div class="col-12 pb-3">
				<h2 class="pt-3">{{ $info->name }}</h2>
				<h4>{{ $info->slogan }}</h4>
			</div>

			<div class="col-12">
				<div class="row">
					<div class="col-md-6 col-sm-12 pb-3">
						{!! $info->description !!}
					</div>
					<div class="col-md-6 col-sm-12 pb-3">
						<ul class="list-unstyled">
							<li>Режим работы: {{ $info->hours }}, {{ $info->weekend }}</li>
							<li>Телефон: {{ $info->phone }}</li>
							<li>Адрес компании: {{ $info->address }}</li>
						</ul>
					</div>
				</div>
			</div>

			@isset($info->map_code)
			<div class="col-12">
				{!! $info->map_code !!}
			</div>
			@endisset
		</div>
	@endif

</section>

@endsection