@extends ('layouts.main')

@section('slider')
    @include('content.slider')
@endsection

@section('products')
<section class="content container pt-4">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-3" >
            @include('content.filter')
        </div>

        <div class="col-12 col-md-9 product-block">
            
        @if(isset($products) && is_object($products))
            @if($products->count() > 0)
                <h2>{{$catName}}</h2>
                <div class="product-type-block">
                    <div class="row"> 
                        @foreach ($products as $k => $item)
                            @include('content.productcell')
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-12" >
                        {!! $products->appends($filter)->links() !!}
                    </div>
                </div>
            @endif
        @endif
        </div>
    </div>
</section>
@endsection