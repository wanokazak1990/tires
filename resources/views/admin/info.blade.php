@extends ('layouts.admin')

@section('content')
	@isset($title)
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>
	@endisset

	@if(isset($visits) && count($visits)>0)
		@foreach($visits as $key => $vis)
			<div class="col-12">{{$vis->getDays($key)}}: {{$vis->count}}</div>
		@endforeach
	@endif

	@if(isset($totalVisit) && !empty($totalVisit))
		<div class="col-12">За всё время: {{$totalVisit}}</div>
	@endif

	@isset($info)
	<div class="col-12 py-3">
		<div class="input-group no-gutters">
			<div class="col-md-2 col-sm-6">
				<a href="{{route('infoedit')}}" class="btn btn-outline-dark btn-block">Изменить</a>
			</div>
		</div>
	</div>
	<div class="col-12">
		<table class="table table-hover">
			<tbody>
				<tr>
					<td width="25%">Название сайта:</td>
					<td>{{ $info->name }}</td>
				</tr>
				<tr>
					<td>Слоган компании:</td>
					<td>{{ $info->slogan }}</td>
				</tr>
				<tr>
					<td>Телефон компании:</td>
					<td>{{ $info->phone }}</td>
				</tr>
				<tr>
					<td>Адрес компании:</td>
					<td>{{ $info->address }}</td>
				</tr>
				<tr>
					<td>Часы работы:</td>
					<td>{{ $info->hours }}</td>
				</tr>
				<tr>
					<td>Выходные дни:</td>
					<td>{{ $info->weekend }}</td>
				</tr>
				<tr>
					<td>Описание компании:</td>
					<td>{!! $info->description or 'Нет описания' !!}</td>
				</tr>
				<tr>
					<td>Электронный адрес админа:</td>
					<td>{{ $info->admin_email or 'Адрес не указан' }}</td>
				</tr>
				<tr>
					<td>Группа в ВК:</td>
					<td>{{ $info->vk_group or 'Ссылка не указана' }}</td>
				</tr>
				<tr>
					<td>Основной логотип:</td>
					<td>
						@if(isset($info->logo))
							<img src="{{ $info->getLogoUrl() }}" width="100">
						@else
							Логотип не загружен
						@endif
					</td>
				</tr>
				<tr>
					<td>Иконка заголовка:</td>
					<td>
						@if(isset($info->title_icon))
							<img src="{{ $info->getTitleIconUrl() }}" width="100">
						@else
							Иконка не загружена
						@endif
					</td>
				</tr>
				<tr>
					<td>Код карты для сайта:</td>
					<td>{{ $info->map_code or 'Код не загружен' }}</td>
				</tr>
				<tr>
					<td>Код метрики для сайта:</td>
					<td>{{ $info->metrics_code or 'Код не загружен' }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	@endisset

@endsection