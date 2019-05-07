@extends ('layouts.main')

@section('slider')
    @include('content.slider')
@endsection

@section('products')
@if(isset($products) and is_array($products))
<section class="content container pt-4">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-3" >
            @include('content.filter')
        </div>

        <div class="col-12 col-md-9 product-block">
            @foreach ($products as $cat_index => $group)
                <h2>{{ $group['category'] }}</h2>
                @if(isset($group['products']) && is_object($group['products']) && $group['products']->count() > 0)
                                      
                    <div class="product-type-block">
                        <div class="row"> 
                            @foreach ($group['products'] as $k => $item)
                                @include('content.productcell')
                            @endforeach
                        </div>
                    </div>

                @endif
                    
                    <div class="row">
                        <div class="col-12 text-right product-more p-0">
                            <a class="btn btn-dark" href="{{route('productlist')}}?category_id={{$cat_index}}">Все {{$group['category']}} в наличии</a>
                        </div>
                    </div>
                
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection


@section('news')
@if(isset($news) && $news->count()>0)
<section class="news">
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <hr>
                        <h2>Новости</h2>
                    </div>
                    <div class="news-slider col-12">
                        @foreach($news as $new)
                        <div class="item-block">
                            <div class="">
                                <div class="date">
                                    {{$new->created_at->format('d.m.Y')}}
                                </div>
                                <img src="{{asset($new->getUrlImg())}}">
                                <div class="title">
                                    {{$new->title}}
                                </div>
                                <div class="description">
                                    {{mb_strimwidth($new->text,0,216,'...')}}
                                </div>
                                <div class="text-right mt-3" >
                                    <a href="{{route('itemnew',['id'=>$new->id])}}" >
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection


@section('feedbacks')
@if(isset($feedbacks) && $feedbacks->count()>0)
<section class="feedback container-fluid">
        <div class="row">
          <div class="container">
            <div class="row">
              <div class="col-12  pt-4">
                <h2>Отзывы</h2>
              </div>
            </div>
            <div class="row" style="">
                @foreach($feedbacks as $feed)
                <div class="col-sm-4 text-center" >
                  <div class="feedback-block" style="">
                    <span class="feedback-name">{{$feed->name}}</span>
                    <p class="feedback-message">
                      {{$feed->text}}
                    </p>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
      </div>
</section>
@endif
@endsection