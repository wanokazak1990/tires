@if(isset($sliders) and is_object($sliders) and $sliders->count() > 0)
<style>
    .slider-info{
        text-align: center;
        width: 100%;
    }
    .slider-title{
        font-family: 'Russo One', sans-serif;
        color: #fc3;
        text-shadow: 1px 1px 1px #000,-1px -1px 1px #000,1px 0px 1px #000, -1px 0px 1px #000, 0px 1px 1px #000, 0px -1px 1px #000;
        width: 100%;
    }
    .slider-text{
        font-family: 'Russo One', sans-serif;
        display: block;
        color: #ddd;
        width: 100%;
        text-shadow: 1px 1px 1px #000,-1px -1px 1px #000,1px 0px 1px #000, -1px 0px 1px #000, 0px 1px 1px #000, 0px -1px 1px #000;
    }
    @media screen and (min-width: 1100px){
        .slider-title{
            font-size: 40px;
        }
        .slider-text{
            font-size: 25px;
        }
    }
    @media screen and (max-width: 1099px) and (min-width: 700px){
        .slider-title{
            font-size: 35px;
        }
        .slider-text{
            font-size: 20px;
        }
    }
    @media screen and (max-width: 699px){
        .slider-title{
            font-size: 30px;
        }
        .slider-text{
            font-size: 20px;
        }
    }
</style>
<section class="sliders">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for($i=0;$i<$sliders->count();$i++)
                <li 
                    data-target="#carouselExampleIndicators" 
                    data-slide-to="{{$i}}" 
                    class="{{ ($i==0) ? 'active' : '' }}"
                >
                </li>
            @endfor
        </ol>
        <div class="carousel-inner">
            @foreach($sliders as $key => $slide)
                <div class="carousel-item header-slider {{ ($key==0)?'active':'' }}" style="background: url('{{ Image::url($slide->img) }}');">
                    @if(!empty($slide->title))
                    <div class="container d-flex align-items-center" style="height: inherit;">
                        <div class="slider-info text-center">
                            <div class="slider-title">{{$slide->title}}</div>
                            <div class="slider-text">{{$slide->text}}</div>
                            @if(!empty($slide->link))
                                <div class="text-center pt-4">
                                    <a class="btn btn-warning" href="{{route('actionitem',['id'=>$slide->link])}}">Подробнее</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon control-slider" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
@endif