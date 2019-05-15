@extends('layouts.main')

@section('contacts')
<section class="container">

	<div class="row">

		<div class="col-12">
			<div class="row">
				<div class="col-md-6 col-sm-12 pb-3">
					<table class="table">
						<tr>
							<td colspan="2">
								<h2 class="head-phone">{{ SiteInfo::getInfo()->name }}</h2>
								<h4 class="head-slogan">{{ SiteInfo::getInfo()->slogan }}</h4>
							</td>
						</tr>
						<tr>
							<td>Режим работы: </td>
							<td>{{ SiteInfo::getInfo()->hours }}, {{ SiteInfo::getInfo()->weekend }}</td>
						</tr>

						<tr>
							<td>Телефон:</td>
							<td>{{ SiteInfo::getInfo()->phone }}</td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td>{{ SiteInfo::getInfo()->admin_email }}</td>
						</tr>
						<tr>
							<td>Адрес компании:</td>
							<td>{{ SiteInfo::getInfo()->address }}</td>
						</tr>
						<tr>
							<td colspan="2" style="font-size: 14px;">
								{!! SiteInfo::getInfo()->description !!}
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-6 col-sm-12 pb-3">
					@isset(SiteInfo::getInfo()->map_code)
	
						{!! SiteInfo::getInfo()->map_code !!}
				
					@endisset
				</div>
			</div>
		</div>

		
	</div>

</section>
@endsection