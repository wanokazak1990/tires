<section class="header">
    <div class="container-fluid">
        <div class="row d-sm-none d-none d-md-block">
            <div class="container" style="border-bottom:1px solid #ccc;">
                <div class="row">
                    <div class="col-12">
                        <nav class="nav p-0">
                            @foreach(App\hm_page::where('status','>','0')->get() as $page)
                                <a class="nav-link" href="{{route('pages',['alias'=>$page->alias])}}">
                                    {{ $page->title }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container pt-3 pb-3 site-info">
                <div class="row">
                    <div class="col-12 col-md-2 d-flex justify-content-center">
                        <img src="{{ Image::url(SiteInfo::getInfo()->logo) }}" style="height:100px; width: 100px; display: block;">
                    </div>
                    
                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-center block-name">
                        <div class="">
                            <div class="head-name">{{ SiteInfo::getInfo()->name }}</div>
                            <div class="head-slogan">{{ SiteInfo::getInfo()->slogan }}</div>
                        </div>
                    </div> 
                    
                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-center block-work">
                        <div class="text-center">
                            <div class="head-name">{{ SiteInfo::getInfo()->hours }}</div>
                            <div class="head-slogan">{{ SiteInfo::getInfo()->weekend }}</div>
                        </div>                    
                    </div> 

                    <div class="col-12 col-md-4 d-flex align-items-center justify-content-center block-phone">
                        <div class="head-info">
                            <div class="d-block d-md-none text-center">
                                <a href="tel: {{ SiteInfo::getInfo()->phone }}">
                                    <i class="icofont icofont-phone-circle"></i>
                                </a>
                            </div>
                            <div class="head-phone">{{ SiteInfo::getInfo()->phone }}</div>
                            <div class="head-address">{{ SiteInfo::getInfo()->address }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row top-menu" >
            <div class="container">
                <nav class="p-0 navbar navbar-expand-lg navbar-light" >
                    <a class="navbar-brand" href="javascript://"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">    
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('main')}}">Главная</a>
                            </li>                       
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript://" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Каталог
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach(App\hm_category::get() as $cat)
                                            <a 
                                                class="dropdown-item" 
                                                href="{{route('productlist')}}/?category_id={{$cat->id}}"
                                            >
                                                {{$cat->name}}
                                            </a>
                                        @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript://" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Сервис
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach(App\hm_service::where('status','>','0')->get() as $service)
                                        <a class="dropdown-item" href="{{route('services',['alias'=>$service->alias])}}">
                                            {{$service->name}}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{route('actionlist')}}">Акции</a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('newslist')}}">Новости</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav my-2 my-lg-0">
                            <li class="nav-item">
                                <a href="javascript://" class="nav-link cart-in-nav" url="{{route('cartshow')}}">
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