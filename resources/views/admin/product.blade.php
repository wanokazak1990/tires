@extends ('layouts.admin')

@section('content')
	<div class="col-12 pt-3 pb-3">
		<a class="btn btn-warning" href="{{route('tovarcreate')}}">
			Добавить
		</a>
	</div>
	@if(isset($list) && is_object($list) && count($list)>0)
		<table class="table product-stock">
		@foreach($list as $item)
			@include('admin.productcell')
		@endforeach
		</table>
		<div class="col-12"> 
			{{$list->links()}}
		</div>
	@endif
@endsection