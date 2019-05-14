@extends('layouts.main')

@section('contacts')
<section class="container">

	<div class="row">
		<div class="col-12 pb-3">
			<h2 class="pt-3">{{ SiteInfo::getInfo()->name }}</h2>
			<h4>{{ SiteInfo::getInfo()->slogan }}</h4>
		</div>

		<div class="col-12">
			<div class="row">
				<div class="col-md-6 col-sm-12 pb-3">
					{!! SiteInfo::getInfo()->description !!}
				</div>
				<div class="col-md-6 col-sm-12 pb-3">
					<ul class="list-unstyled">
						<li>Режим работы: {{ SiteInfo::getInfo()->hours }}, {{ SiteInfo::getInfo()->weekend }}</li>
						<li>Телефон: {{ SiteInfo::getInfo()->phone }}</li>
						<li>Адрес компании: {{ SiteInfo::getInfo()->address }}</li>
					</ul>
				</div>
			</div>
		</div>

		@isset(SiteInfo::getInfo()->map_code)
		<div class="col-12">
			{!! SiteInfo::getInfo()->map_code !!}
		</div>
		@endisset
	</div>

</section>
@endsection