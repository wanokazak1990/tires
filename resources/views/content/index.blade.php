@extends ('layouts.main')

@section('slider')
    @include('content.slider')
@endsection

@section('products')
@if(isset($products) and is_array($products))
<section class="content container pt-4">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-3 mb-3">
            @include('content.filter')
        </div>

        <div class="col-12 col-md-9 product-block">
            @foreach ($products as $cat_index => $group)
                <h2>{{ $group['category'] }}</h2>
                @if(isset($group['products']) && is_object($group['products']) && $group['products']->count() > 0)
                                      
                    <div class="product-type-block">
                        <div class="input-group no-gutters"> 
                            @foreach ($group['products'] as $k => $item)
                                @include('content.productcell')
                            @endforeach
                        </div>
                    </div>

                @endif
                    
                    <div class="input-group no-gutters">
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


@section('why')
<!---->
<section>

    @if(isset($services) && is_object($services) && count($services))
    <div class="container">
        <div class="row">
            <div class="col-12 block-title">
                Наш сервис
            </div>
        </div>

        <div class="row mt-3 mb-3">
            @foreach($services as $serv)
            <div class="col-md-3 col-12 mb-3">
                <div style="border:1px solid #ccc;padding: 15px;">
                    <div class="text-center">
                        <img style="border-radius:10px;height: auto; width:100%;" src="{{Image::url($serv->icon)}}">
                    </div>
                    <div class="text-center mt-3 mb-3" style="font-weight: bold;">
                        {{$serv->name}}
                    </div>
                    <div class="text-center">
                        <a href="{{route('services',['alias'=>$serv->alias])}}" class="btn btn-block btn-warning">
                            Подробнее
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @include('content.servicerecord')

    <div class="container">
        <div class="row d-flex align-items-center">
                <div class="col-12 col-md-7">
                    
                    <h2 class="block-title">Почему нужно обращаться в автосервис?</h2>
                                      
                    <p>
                        Безопасности при управлении зависит в первую очередь от качества шин, поэтому при любых нарушениях важно обратиться в автосервис, где на специальном оборудовании будет произведен ремонт.
                    </p>
                    <p style="">
                        В автосервисе при проведении шиномонтажных работ специалистом будет устранен любой дефект шин (грыжа, порез, прокол). Также в рамках проведения шиномонтажа будет проведена балансировка и устранение любых неисправностей дисков, что позволит гарантировать не только долговечность шин в эксплуатации, но и повысить безопасность езды. Своевременно выполненный шиномонтаж – гарантия комфортного и безопасного движения, устойчивость на поворотах и правильного шум колес.
                    </p>
                    <p>
                        Не экономьте, доверяйте выполнение всех работ по шиномонтажу, только опытным мастерам, которые способны учесть все до последней мелочи своевременно выявить малейшие дефекты и быстро их устранить.
                    </p>               
                </div>

                <div class="col-12 col-sm-5" style="padding-top: 30px;">
                    <img class="fly-img" style="width: 100%; height: auto;" src="{{asset('/assets/images/imgtires2.png')}}">
                </div>
        </div>
    </div>

    
</section>
<!---->
@endsection




@section('feedbacks')
@if(isset($feedbacks) && $feedbacks->count()>0)
<section class="feedback container-fluid">
    <div class="row">
        <div class="container">
            
            <div class="row">
              <div class="col-12">
                <h2 class="text-left block-title">Отзывы наших клиентов</h2>
              </div>
            </div>

            <div class="row feedback-slider">
                @foreach($feedbacks as $feedback)
                <div class="col">
                    <div class="feedback-block">
                        <div class="img" style="background:url('{{Image::url($feedback->img)}}');"></div>
                        <div class="feedback-name text-center">
                            {{$feedback->name}}
                        </div>
                        <div class="feedback-message text-center">
                            {{$feedback->text}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endsection


@section('news')
@if(isset($news) && $news->count()>0)
<section class="news">
    <div class="container-fluid news-back">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-left block-title">Новости</h2>
                    </div>

                    <div class="news-slider col-12 d-flex align-items-center">
                        @foreach($news as $new)
                        <div class="item-block" style="background: url('{{Image::url($new->img)}}'); background-size: cover; background-position: center;">
                            <div class="white-bg" style="">
                                <div class="date">
                                    {{$new->created_at->format('d.m.Y')}}
                                </div>
                                <div style="border-radius:5px;width: 100%; height: 200px; ">
                                </div>
                                <div style="background: linear-gradient(to top,#fff 40%,transparent 100%);padding: 15px;">
                                    <div class="title" style="">
                                        {{$new->title}}
                                    </div>
                                    <div class="description" style="">
                                        {!! mb_strimwidth($new->small,0,216,'...') !!}
                                    </div>
                                    <div class="text-center mt-3" >
                                        <a class="btn btn-dark" href="{{route('itemnew',['id'=>$new->id])}}" >
                                            Подробнее
                                        </a>
                                    </div>
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