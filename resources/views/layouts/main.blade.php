@section('header')
<!doctype html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="{{ SiteInfo::getInfo()->keywords }}" />
    <meta name="description" content="{{ SiteInfo::getInfo()->searchdesc }}" />

    <meta property = "og:title" content="{{ (isset($og['title'])) ? $og['title'] : SiteInfo::getInfo()->name }}" />
    <meta property = "og:image" content="{{ (isset($og['image'])) ? $og['image'] : Image::url(SiteInfo::getInfo()->og_image) }}" />
    <meta property = "og:type" content = "article" />
    <meta property = "og:description" content = "{{ (isset($og['desc'])) ? $og['desc'] : SiteInfo::getInfo()->searchdesc }}" />

    <link rel="shortcut icon" href="{{ SiteInfo::getInfo()->getTitleIconUrl() }}" type="image/png">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style/main.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">    

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap&subset=cyrillic" rel="stylesheet">
    
    <link href="{{ asset('/assets/fonts/icofont/icofont.min.css') }}" rel="stylesheet">
    
    <link rel="preconnect" href="//api-maps.yandex.ru">
    <link rel="dns-prefetch" href="//api-maps.yandex.ru">

    <title>{{ SiteInfo::getInfo()->name }}</title>
</head>

<body>
    <span style="display: none;" id="cartpreloader" url="{{route('cartindikator')}}"></span>

    @include('content.header')
@show

@section('slider')
@show

@section('products')      
@show

@section('why')
@show



@section('page')
@show

@section('contacts')
@show

@section('feedbacks')
@show

@section('news')
@show

<section class="footer container-fluid">
    <div class="row h-100">
        <div class="container h-100">
            <div class="input-group no-gutters text-light d-flex align-items-center pb-3">
                <div class="col-12 col-md-6 col-sm-12 ">
                    <div class="row ">
                        <div class="col-12 col-sm-3 d-none d-sm-block">
                            <img src="{{ Image::url(SiteInfo::getInfo()->logo) }}" style="width: 100%; height: 100%;"> 
                        </div>
                        <div class="col-md-9 col-12 text-left">
                            <div class="head-name">
                                {{ SiteInfo::getInfo()->name }}
                            </div>
                            <table style="color: #ccc;font-size: 14px;" class="mt-3 d-block">                       
                                <tr>
                                    <td style="padding-right: 10px;">Телефон:</td>
                                    <td class=""  style="">{{ SiteInfo::getInfo()->phone }}</td>
                                </tr>
                                <tr>
                                    <td  style="padding-right: 10px;">Адрес:</td>
                                    <td  class="" style=""> {{ SiteInfo::getInfo()->address }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="block-work pt-3" >
                                            <div class="text-center">
                                                
                                            </div>  
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="head-name">
                            {{ SiteInfo::getInfo()->hours }}
                    </div>
                    <div class="head-slogan">
                        {{ SiteInfo::getInfo()->weekend }}
                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <ul class="list-unstyled m-0 py-3 text-center">
                        <li style=""><a href="{{route('main')}}" class="text-light">Главная</a></li>
                        <li style=""><a href="{{route('newslist')}}" class="text-light">Новости</a></li>
                        <li style=""><a href="{{route('actionlist')}}" class="text-light">Акции</a></li>
                        @foreach(App\hm_page::where('status','>','0')->get() as $page)
                            <li style=""><a href="{{route('pages',['alias'=>$page->alias])}}" class="text-light">{{ $page->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="input-group no-gutters text-light d-flex justify-content-end">
                <span>2019 © Все права защищены.</span>
            </div>
        </div>
    </div>
</section>

@isset($map)
<section class="container-fluid ya-map" style="padding: 0px">
    {!! $map !!}
</section>
@endisset

<div id="toTop">
    <i class="icofont-arrow-up"></i>
</div>


<!--SPINER-->
<div class="loader-wrapper" style="display: none; padding: 20px 0px;">
    <div class="loader">
        <div class="inner one"></div>
        <div class="inner two"></div>
        <div class="inner three"></div>
    </div>
</div>

@include('content.productmodal')

@include('content.cartmodal')

@include('content.ordermodal')

@include('content.modal')

@include('content.jscripts')

    <script>
        $(document).ready(function(){

            var header = $('section[class="header"]');
            var content = $('section[class="container"]');
            var footer = $('section[class="footer container-fluid"]');

            if ((header.height() + content.height() + footer.height()) < $(window).height())
                content.height($(window).height() - header.height() - footer.height());

            $('.input-phone').mask('8 (999) 99-99-999');

            //PRODUCT CLICK MORE BUTTON
            $(document).on('click','.product .more',function(){
                
                let m_modal = $('#modalProduct')
                let m_table = m_modal.find('#product-attributes')
                let m_price = m_modal.find('#price')
                let m_image = m_modal.find('#main-img')
                let m_desc = m_modal.find('.description')
                let m_more = m_modal.find('.tocart')

                let url = $(this).closest('.product').attr('view-url')
                let parameters = {'id':$(this).attr('product-id')}

                $.when(ajax(parameters,url).then(function(data){
                    data = JSON.parse(data)
                    m_modal.find('.modal-title').html(data.name)
                    m_table.html('')
                    for(i in data.attributes)
                    {
                        let obj = data.attributes[i]
                        m_table.append('<tr><td>'+obj.attr_name.name+'</td><td>'+data.attributes[i].parameter.value+'</td></tr>')

                    }
                    m_price.html(data.price)
                    m_image.attr('src',data.img)
                    m_desc.html(data.description)
                    m_more.attr('product-id',data.id)
                    m_modal.modal('show')
                }))
            });

            //BORDER PRODUCT
            var productBlockWidth = $('.product-block').outerWidth()
            var productCellWidth = $('.product-block .product-cell').width()
            var cellInLine = Math.floor(productBlockWidth / productCellWidth)
            $('.product-type-block').each(function(){
                let line = $(this)
                let count = line.find('.product-cell').length
                line.find('.product-cell').each(function(k){
                    let product = $(this)
                    product.css({
                        'border-top':'1px solid #ddd',
                        'border-left':'1px solid #ddd',
                        'border-right':'1px solid #ddd',
                        'border-bottom':'1px solid #ddd'
                    })
                    if((k+1)%cellInLine>0 && (k+1)!=count)
                        product.css({'border-right':'1px solid transparent'})
                    if((k+1)>cellInLine)
                        product.css({'border-top':'1px solid transparent'})
                })    
            });

            oneHeight('.feedback-message');
            oneHeight('.news-slider .description');
            oneHeight('.news-slider .title');

        });

    </script>
</body>
</html>