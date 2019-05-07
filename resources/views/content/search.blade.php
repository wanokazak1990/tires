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
				<div class="col-6">
					@if(isset($search['stock_disk']) && is_array($search['stock_disk']))
						<h5>Рекомендованные заводом диски</h5>						
						@foreach($search['stock_disk'] as $disk)
							<div>
								<a href="{{route('searchresult',['params'=>implode('+',$disk)])}}">
								@foreach($disk as $key=>$item)
									@if($key!='category_id')
										{{$item}}
									@endif
								@endforeach
								</a>
							</div>
						@endforeach
					@endif

					@if(isset($search['change_disk']) && is_array($search['change_disk']))
						<h5>Допустимые к установке диски</h5>						
						@foreach($search['change_disk'] as $disk)
							<div>
								<a href="{{route('searchresult',['params'=>implode('+',$disk)])}}">
								@foreach($disk as $key=>$item)
									@if($key!='category_id')
										{{$item}}
									@endif
								@endforeach
								</a>
							</div>
						@endforeach
					@endif
				</div>

				<div class="col-6">
					@if(isset($search['stock_tires']) && is_array($search['stock_tires']))
						<h5>Рекомендованные заводом шины</h5>						
						@foreach($search['stock_tires'] as $tire)
							<div>
								<a href="{{route('searchresult',['params'=>implode('+',$tire)])}}">
								@foreach($tire as $key=>$item)
									@if($key!='category_id')
										{{$item}}
									@endif
								@endforeach
								</a>
							</div>
						@endforeach
					@endif

					@if(isset($search['change_tires']) && is_array($search['change_tires']))
						<h5>Допустимые к установке шины</h5>						
						@foreach($search['change_tires'] as $tire)
							<div>
								<a href="{{route('searchresult',['params'=>implode('+',$tire)])}}">
								@foreach($tire as $key=>$item)
									@if($key!='category_id')
										{{$item}}
									@endif
								@endforeach
								</a>
							</div>
						@endforeach
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