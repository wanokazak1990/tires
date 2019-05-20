@extends ('layouts.admin')

@section('content')
	@isset($title)
	<div class="col-12 pt-3">
		<div class="h3">{{ $title }}</div>
	</div>
	@endisset

	@isset($info)
	<div class="col-12">
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Название сайта:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="name" value="{{ $info->name }}" class="form-control">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Слоган компании:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="slogan" value="{{ $info->slogan }}" class="form-control">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Телефон компании:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="phone" value="{{ $info->phone }}" class="form-control">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Адрес компании:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="address" value="{{ $info->address }}" class="form-control">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Часы работы:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="hours" value="{{ $info->hours }}" class="form-control">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Выходные дни:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="weekend" value="{{ $info->weekend }}" class="form-control">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Ключевые слова:
			</div>
			<div class="col-md-8 col-sm-12">
				<textarea name="keywords">{{ $info->keywords }}</textarea>
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Ключевое описание(поисковикам):
			</div>
			<div class="col-md-8 col-sm-12">
				<textarea name="searchdesc">{{ $info->searchdesc }}</textarea>
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Описание компании:
			</div>
			<div class="col-md-8 col-sm-12">
				<textarea id="editor" name="description">{{ $info->description }}</textarea>
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Электронный адрес админа:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="admin_email" value="{{ $info->admin_email or '' }}" class="form-control" placeholder="Email">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Группа в ВК:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="vk_group" value="{{ $info->vk_group or '' }}" class="form-control" placeholder="Ссылка на группу в ВК">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Логотип сайта:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="file" name="logo" class="form-control-file">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Иконка заголовка (в формате .PNG):
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="file" name="title_icon" class="form-control-file">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Карта для сайта:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="map_code" value="{{ $info->map_code or '' }}" class="form-control" placeholder="Код карты для сайта">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-4 col-sm-12 d-flex align-items-center">
				Метрика для сайта:
			</div>
			<div class="col-md-8 col-sm-12">
				<input type="text" name="metrics_code" value="{{ $info->metrics_code or '' }}" class="form-control" placeholder="Код метрики для сайта">
			</div>
		</div>

		<div class="input-group no-gutters mb-2">
			<div class="col-md-2 col-sm-12">
				{{Form::submit('Применить', ['class'=>'btn btn-success btn-block'])}}
			</div>
		</div>
		{{Form::close()}}	
	</div>
	@endisset
@endsection