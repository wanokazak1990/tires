@if(isset($sliders) and is_object($sliders) and $sliders->count() > 0)
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
                <div class="carousel-item {{ ($key==0)?'active':'' }}" style="background: url('{{ Image::url($slide->img) }}');">
                    
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
@endif