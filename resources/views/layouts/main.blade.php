@section('header')
<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('/assets/style/main.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="{{ asset('/assets/fonts/icofont/icofont.min.css') }}" rel="stylesheet">

    
    <title>Hello, world!</title>
  </head>
  <body>
    <span style="display: none;" id="cartpreloader" url="{{route('cartindikator')}}"></span>

<section class="header">
    <div class="container-fluid  ">
        <div class="row ">
            <div class="container" style="border-bottom:1px solid #ccc;">
                <div class="row">
                    <div class="col-8">
                        <nav class="nav p-0">
                            <a class="nav-link" href="#">Магазин</a>
                            <a class="nav-link" href="#">Как купить</a>
                            <a class="nav-link" href="{{route('newslist')}}">Новости</a>
                            <a class="nav-link" href="#">Статьи</a>
                            <a class="nav-link" href="#">Шиномонтаж</a>
                            <a class="nav-link" href="#">Контакты</a>
                        </nav>
                    </div>

                    <div class="col-4 ">
                        <nav class="nav justify-content-end">
                            @if(isset(Auth::user()->name))
                                <a class="nav-link" href="">
                                    Личный кабинет
                                </a>
                                <a 
                                    class="nav-link" 
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Выход
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <a class="nav-link" href="{{route('login')}}">
                                    Вход
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container pt-3 pb-3">
                <div class="row">
                    <div class="col-6 col-sm-2 justify-content-start d-flex ">
                        <img src="{{ asset('/assets/images/logo.jpg') }}" style="height:100px;width: 100px;display: block;">                        
                    </div>
                    
                    <div class="col-6 col-sm-3 d-flex">
                        <div class="align-self-center">
                            <div class="head-name">Автоцентр Hofmann</div>
                            <div class="head-slogan">Шины для Вашей машины</div>
                        </div>
                    </div> 
                    
                    <div class="col-12 col-sm-4 d-flex">
                        <div class="align-self-center text-center text-center" style="width: 100%;">
                            <div class="head-name">24 / 7</div>
                            <div class="head-slogan">Без выходных</div>
                        </div>                    
                    </div> 

                    <div class="col-12 col-sm-3 d-flex">
                        <div class="align-self-center head-info pl-3">
                                <div class="head-phone">8 (8212) 553-997</div>
                                <div class="head-address">г.Сыктывкар, ул.Орджоникидзе, 87</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row top-menu" >
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">    
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('main')}}">Главная</a>
                            </li>                       
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Каталог
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(isset($categories) && $categories->count()>0)
                                        @foreach($categories as $cat)
                                            <a 
                                                class="dropdown-item" 
                                                href="{{route('productlist')}}/?category_id={{$cat->id}}"
                                            >
                                                {{$cat->name}}
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Сервис
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Шины</a>
                                    <a class="dropdown-item" href="#">Диски</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Прочее</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{route('main')}}">Акции</a>
                            </li> 
                        </ul>

                        <ul class="navbar-nav my-2 my-lg-0">
                            <li class="nav-item">
                                <a class="nav-link cart-in-nav" url="{{route('cartshow')}}">
                                    <i class="icofont-cart"></i>
                                    <span class="cart-indikator">Корзина</span>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
@show

@section('slider')

@show

@section('products')
            
@show


@section('news')

@show

<section class="myquality container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <i class="icofont-wall-clock"></i>
                        <span>Круглосуточный<br> режим работы</span>
                    </div>
                    <div class="col-12 col-md-3">
                        <i class="icofont-money"></i>
                        <span>Доступные<br> цены</span>
                    </div>
                    <div class="col-12 col-md-3">
                        <i class="icofont-repair"></i>
                        <span>Большой опыт<br> работы</span>
                    </div>
                    <div class="col-12 col-md-3">
                        <i class="icofont-help-robot"></i>
                        <span>Современное<br> оборудование</span>
                    </div>
                </div>
            </div>
        </div> 
</section>


@section('feedbacks')

@show

<section class="contact container-fluid">
    
</section>



<section class="container-fluid">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A3978e8318169f3aab86f19dd45446ed09bfae7ddd3680ca15f380404aaa305da&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>   
</section>

<section class="footer container-fluid">
    FOOTER
</section>


    @include('content.productmodal')

    @include('content.cartmodal')

    @include('content.ordermodal')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    -->
    <script src="{{ asset('/assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="{{ asset('/assets/lib/jQueryFormStyler-master/dist/jquery.formstyler.min.js') }}"></script>
    <link href="{{ asset('/assets/lib/jQueryFormStyler-master/dist/jquery.formstyler.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/lib/jQueryFormStyler-master/dist/jquery.formstyler.theme.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/lib/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/lib/slick/slick-theme.css') }}"/>
    <script type="text/javascript" src="{{ asset('/assets/lib/slick/slick.min.js') }}"></script>
    <script>
      $('.news-slider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        ]
      });
    </script>
    <script src="{{asset('/assets/js/cart.js') }}"></script>
    <script src="{{asset('/assets/js/function.js')}}"></script>
    <script src="{{asset('/assets/js/filter.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(function() {
                //$('select').styler();
            });


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
            })


            //FIXED ELEMENTS
            var menuOffsetTop = $('.top-menu').offset().top
            var filterOffsetTop = $('.filter-block').offset().top
            var displayWidth = $(window).width();
            var lastProductEndPos = $('.product-block').offset().top+$('.product-block').height()-50

            $(document).on('scroll',function(){
                if(displayWidth>755){
                    if($('.filter-block').height()>$('.product-block').height())
                        $('.product-block').height($('.filter-block').height())

                    let menu = $('.top-menu')
                    if(menuOffsetTop<$(this).scrollTop())
                        menu.css({
                            'width':($('body').width()+15)+'px',
                        }).addClass('fixed-menu')
                    else{
                        menu.css({
                             'width':($('body').width())+'px'                      
                        }).removeClass('fixed-menu')
                    }
                    
                    let filter = $('.filter-block')
                    if(filterOffsetTop<$(this).scrollTop()+100)
                        filter.css({
                            'position':'fixed',
                            'top':'60px',
                            'width':filter.parent().width()+'px'
                        })
                    else if(filterOffsetTop>$(this).scrollTop())
                        filter.css({
                            'position':'static'
                        })

                    let offFilterPos = filter.offset().top+filter.height()
                    if(offFilterPos>=lastProductEndPos)
                        filter.css({
                            'position':'absolute',
                            'top':(lastProductEndPos-filter.height()-filter.parent().offset().top-10)+'px'
                        })
                }
            })

            $(window).on('resize',function(){
                menuOffsetTop = $('.top-menu').offset().top
                filterOffsetTop = $('.filter-block').offset().top
                displayWidth = $(window).width();
                lastProductEndPos = $('.product:last').offset().top+$('.product:last').height()
                let filter = $('.filter-block')
                let menu = $('.top-menu')
                filter.css({
                            'position':'static',
                            'width':'100%'
                        })
                if(displayWidth>755){
                    
                    if(menuOffsetTop<$(this).scrollTop())
                        menu.css({
                            'width':($('body').width()+15)+'px',
                        }).addClass('fixed-menu')
                    else{
                        menu.css({
                             'width':($('body').width())+'px'                      
                        }).removeClass('fixed-menu')
                    }
                    
                    
                    if(filterOffsetTop<$(this).scrollTop()+100)
                        filter.css({
                            'position':'fixed',
                            'top':'60px',
                            'width':filter.parent().width()+'px'
                        })
                    else if(filterOffsetTop>$(this).scrollTop())
                        filter.css({
                            'position':'static'
                        })

                    let offFilterPos = filter.offset().top+filter.height()
                    if(offFilterPos>=lastProductEndPos)
                        filter.css({
                            'position':'absolute',
                            'top':(lastProductEndPos-filter.height()-filter.parent().offset().top-10)+'px'
                        })
                }
            })

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
            })

            
            



            

            
            

        })
    </script>
</body>
</html>