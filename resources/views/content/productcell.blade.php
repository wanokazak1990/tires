<?php 
/*
    Шаблон для плиток товаров
    обязательно передаётся сам продукт в переменной $item
    у этого продукта в коллекции должны быть
    аттрибуты (в контроллере ->with('attributes')) $item->attributes
    так же в шаблон передаётся массив с именами аттрибутов в категории
    то есть массив $attributes[category_id][attribute_id] = Профиль шины
*/
?>
<div class="col-6 col-sm-6 col-md-4 col-lg-3 p-0 product-cell" >
    <div class="product" view-url="{{route('ajaxproduct')}}">                        
        <div class="product-name">
            {{$item->name}}
        </div>
        <div class="product-img">
            <img src="{{$item->getUrlImg()}}">
        </div>
        <div class="product-info">
            <table class="product-table">
                @foreach($item->attributes as $product_value)
                    <tr>
                        <td>
                            {{@$attributes[$item->category_id][$product_value->attribute_id]}}                                                
                        </td>
                        <td>
                            {{@$product_value->parameter->value}}
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="small-visible">
            @foreach($item->attributes as $t=>$product_value)
                {{@$attributes[$item->category_id][$product_value->attribute_id]}}
                :
                {{@$product_value->parameter->value}}
                {{($t<$item->attributes->count()-1)?'|':''}}
            @endforeach
            </div>
            <div class="row">
                <div class="product-price col-12 ">
                    <div class="">
                        {{ $item->price }} <i class="icofont-rouble"></i>
                    </div>
                </div>
            </div>
            <div class="bs">
                <div class="col-12 ">
                    <div class="btn-group">
                        <button class="btn btn-secondary more" product-id="{{$item->id}}">
                            <span class="d-sm-block d-lg-none">
                                <i class="icofont-info-circle"></i>
                            </span>
                            <span class="d-none d-lg-block">
                                Подробнее
                            </span>
                        </button>
                        <button class="btn btn-warning tocart" product-id="{{$item->id}}" url="{{route('cartadd')}}">
                            <span class="d-sm-block d-lg-none">
                                <i class="icofont-cart"></i>
                            </span>
                            <span class="d-none d-lg-block">
                                В корзину
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>