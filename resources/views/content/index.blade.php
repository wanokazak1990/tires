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
                                <div style="width: 100%; height: 200px; background: url('{{Image::url($new->img)}}'); background-size: cover; background-position: center;">
                                </div>
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
                    
                    <!-- @foreach($news as $key => $new)
                        @if($key < 3)
                        <div class="col-sm-12 col-md-4 mb-3">
                            <div class="card">
                                <div class="card-img-top border-bottom" style="width: 100%; height: 200px;">
                                    <img class="" src="{{ asset($new->getUrlImg()) }}" alt="News Image" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $new->title }}</h5>
                                    <p class="card-text">{{ mb_strimwidth($new->text,0,216,'...') }}</p>
                                </div>
                                <div class="text-right mr-3 mb-2">
                                    <a href="{{route('itemnew',['id'=>$new->id])}}" class="btn btn-light">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                            @break
                        @endif
                    @endforeach -->

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
                <div class="col-sm-4 text-center">
                  <div class="feedback-block pt-3" style="">
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