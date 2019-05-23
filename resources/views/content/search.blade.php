@extends('layouts.main')

@section('products')
<section class="container">
	<div class="row pt-4 pb-4">
		<div class="col-12 col-sm-12 col-md-3">
			@include('content.filter')
		</div>

		<div class="col-12 col-md-9 product-block">
			@if(!empty($search))
			<div class="row">
				<div class="col-md-6 col-sm-12 mt-3">
					<div class="d-flex align-items-center justify-content-center mb-3">
						<img src="{{ asset('/assets/images/wheel.png') }}" style="width: 30%; height: auto;">
					</div>
					@if(isset($search['stock_disk']) && is_array($search['stock_disk']))
						<h5>Рекомендованные заводом диски</h5>
						<div class="list-group">						
						@foreach($search['stock_disk'] as $disk)
							<a href="{{route('searchresult',['params'=>implode('+',$disk)])}}" class="list-group-item list-group-item-action">
							@foreach($disk as $key=>$item)
								@if($key!='category_id')
									{{$item}}
								@endif
							@endforeach
							</a>
						@endforeach
						</div>
					@endif

					@if(isset($search['change_disk']) && is_array($search['change_disk']))
						<h5 class="mt-4">Допустимые к установке диски</h5>						
						<div class="list-group">
						@foreach($search['change_disk'] as $disk)
							<a href="{{route('searchresult',['params'=>implode('+',$disk)])}}" class="list-group-item list-group-item-action">
							@foreach($disk as $key=>$item)
								@if($key!='category_id')
									{{$item}}
								@endif
							@endforeach
							</a>
						@endforeach
						</div>
					@endif
				</div>

				<div class="col-md-6 col-sm-12 mt-3">
					<div class="d-flex align-items-center justify-content-center mb-3">
						<img src="{{ asset('/assets/images/tires.png') }}" style="width: 30%; height: auto;">
					</div>
					@if(isset($search['stock_tires']) && is_array($search['stock_tires']))
						<h5>Рекомендованные заводом шины</h5>						
						<div class="list-group">
						@foreach($search['stock_tires'] as $tire)
							<a href="{{route('searchresult',['params'=>implode('+',$tire)])}}" class="list-group-item list-group-item-action">
							@foreach($tire as $key=>$item)
								@if($key!='category_id')
									{{$item}}
								@endif
							@endforeach
							</a>
						@endforeach
						</div>
					@endif

					@if(isset($search['change_tires']) && is_array($search['change_tires']))
						<h5 class="mt-4">Допустимые к установке шины</h5>						
						<div class="list-group">
						@foreach($search['change_tires'] as $tire)							
							<a href="{{route('searchresult',['params'=>implode('+',$tire)])}}" class="list-group-item list-group-item-action">
							@foreach($tire as $key=>$item)
								@if($key!='category_id')
									{{$item}}
								@endif
							@endforeach
							</a>
						@endforeach
						</div>
					@endif
				</div>
			</div>
			@else
				<div class="row"><div class="col-12">
					<h3>К сожалению по Вашим параметрам не нашлось ни одного товара</h3>
				</div></div>
			@endif
		</div>
	</div>
</section>
@endsection