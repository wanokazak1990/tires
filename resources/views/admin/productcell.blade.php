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
<tr>                       
    <td class="product-name">
        {{$item->name}}
    </td>
    <td class="product-img">
        <img src="{{$item->getUrlImg()}}">
    </td>
    <td class="product-info">
        <table class="product-table">
            @foreach($item->attributes as $product_value)
                <tr>
                    <td>
                        {{@$product_value->attrName->name}}
                    </td>
                    <td>
                        {{@$product_value->parameter->value}}
                    </td>
                </tr>
            @endforeach
        </table>
    </td>
    <td>
        {{number_format($item->price,0,'',' ')}} руб.
    </td>
    <td>
        {{$item->available}}
    </td>
    <td class="{{($item->status)?'text-success':''}}" style="width: 50px" >
        <i class="icofont-power admin-icon"></i>
    </td>
    <td>
        <a href="{{route('tovarshow',['id'=>$item->id])}}">
            <i class="icofont-edit admin-icon"></i>
        </a>         
    </td>
</tr>