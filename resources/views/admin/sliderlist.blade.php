@extends ('layouts.admin')

@section('content')

	@if(isset($list))
		<div class="col-12 pt-3 pb-3"><a class="btn btn-warning" href="{{route('slidercreate')}}">Добавить</a></div>
		@if(count($list)) 
		<div class="col-12">
			<div class="content-list container">
				<div class="row">
					@foreach($list as $slide)
					<div class="col-4 p-0 content-item">
						<div style="border-left: 1px solid #fff;border-bottom: 1px solid #fff;">
							<a class="content-del" data-id="{{$slide->id}}" url="{{route('sliderdelete')}}">
								x
							</a>
							<div class="content-block">
								<div class="content-img" style="background: url('{{$slide->getUrlImg()}}');">
									<a href="{{ route('slidershow', ['id'=>$slide->id] ) }}"></a>
								</div>
							</div>
							<div class="content-title">
								<a href="{{ route('slidershow', ['id'=>$slide->id] ) }}">
									{{$slide->title}}
								</a>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
		@else
			<div class="">Вы ещё не создали ни одного слайда.</div>
		@endif
	@endif

	@if(isset($slider) && !empty($slider))
	<div class="admin-editor">
		
		{{Form::open(array('files'=>'true','url'=>$route))}}
		<div class="container"> 
			<div class="row"> 
				<div class="col-md-6 col-sm-12">
					{{Form::label('title','Заголовок')}}
					{{Form::text('title',$slider->title,['class'=>'form-control mb-2'])}}
				
					{{Form::label('title','Текст')}}
					{{Form::textarea('text',$slider->text,['class'=>'form-control mb-2'])}}

					{{Form::label('title','Ссылка')}}
					{{Form::text('link',$slider->link,['class'=>'form-control mb-2'])}}

					{{Form::label('title','Статус')}}
					{{Form::checkbox('status',1,($slider->status)?'true':'')}}
				</div>	

				<div class="col-md-6 col-sm-12">
					{{Form::label('title','Файл')}}
					@if(!empty($slider->img))
						<img src="{{ $slider->getUrlImg() }}" class="mb-2">
					@endif
					{{Form::file('img')}}
				</div>	

				<div class="col-12">
					{{Form::submit('OK')}}
				</div>	
			</div>
		</div>
		{{Form::close()}}
		
	</div>
	@endif

@endsection