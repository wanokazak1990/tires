//FLYING TO THE CART
function ballToCart(obj,status=1){
    var ball
    if(obj.closest('.product').length>0)
        ball = obj.closest('.product').find('img')
    else if(obj.closest('.modal-product').length>0)
        ball = obj.closest('.modal-product').find('img')

    var cart = $(".cart-in-nav");
    var w = ball.width();
    ball.clone()
    .css({'width' : w,
        'position' : 'absolute',
        'z-index' : '9999',
        top: ball.offset().top,
        left:ball.offset().left
    })
    .appendTo("body")
    .animate({
            opacity: 0.05,
            left: cart.offset().left,
            top: cart.offset().top,
            width: 20
        }, 1000, function() {  
            $(this).remove();
    });
}

    
$(document).ready(function(){
    //ADD TO CART
    $(document).on('click','.tocart',function(){
        let button = $(this)
        let parameters = {'id':button.attr('product-id')}
        let url = button.attr('url')
        $.when(ajax(parameters,url).then(function(data){
            data = JSON.parse(data)
            ballToCart(button)
            cartIndikators(data)
            CheckProductOnCart()
        }))
    })


    $(document).on('click','.tocart_modal',function(){
        
        let button = $(this)
        let m_modal = button.closest('#modalCart')
        let total_price = m_modal.find('.total')

        let item_product = button.closest('.item_product')
        let item_count = item_product.find('.item_count')
        let item_price = item_product.find('.item_price')

        let parameters = {'id':button.attr('product-id')}
        let url = button.attr('url')

        $.when(ajax(parameters,url).then(function(data){
            data = JSON.parse(data)
            cartIndikators(data)
            total_price.html(data.total_price)
            item_count.html(data.item_count)
            item_price.html(data.item_price)
            if(data.item_count<1){
                item_product.remove()
                CheckProductOnCart()
            }
        }))
    })


    //OPEN CART
    $(document).on('click','.cart-in-nav',function(){
        let m_modal = $('#modalCart')
        let m_title = m_modal.find('.modal-title')
        let m_table = m_modal.find('.cart-product')
        let button = $(this)
        let total = m_modal.find('.total')

        let url = button.attr('url')
        let parameters = {'cart':'show'}

        $.when(ajax(parameters,url).then(function(data){
            m_title.html('Корзина')
            data = JSON.parse(data)
            m_table.html('')  
            var k=0           
            for(i in data['cart'])
            {
                k++
                var str = ''
                var count = Object.keys(data['cart']).length
                if(k<count)
                   str = 'style="border-bottom:1px solid #ddd;padding-top:10px;padding-bottom:10px;"' 

                let obj = data['cart'][i]                 
                m_table.append('<div class="row item_product d-flex " '+str+'>'+
                        '<div class="col-3 col-md-2 align-self-center"><img src="'+obj.img+'"></div>'+
                        '<div class="col-9 col-md-8 align-self-center">'+
                            '<div class="row">'+
                                '<div class="col-12">'+obj.name+'</div>'+
                                '<div class="col-12">Цена (штука): '+obj.price+' руб.</div>'+
                                '<div class="col-12">Цена (всего): <span class="item_price">'+obj.item_price+'</span> руб.</div>'+
                                '<div class="col-12">Кол-во: <span class="item_count">'+obj.count+'</span> шт.</div>'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="text-right col-12 col-md-2 align-self-center">'+
                            '<div class="btn-group">'+
                                '<a class="tocart_modal btn btn-success" product-id="'+obj.id+'" url="'+m_modal.attr('url-add')+'"><i class="icofont-plus"></i></a>'+
                                '<a class="tocart_modal btn btn-danger" product-id="'+obj.id+'" url="'+m_modal.attr('url-take')+'"><i class="icofont-minus"></i></a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                )                
            }
            total.html(data.total_price)
            m_modal.modal('show')
        }))
    })

    $(window).on('resize',function(){
        
    })
    //МЕНЯЕТ СОСТОЯНИЕ КНОПКИ ДОБАВИТЬ В КОРЗИНУ
    function CheckProductOnCart(){
        var append = '<i class="icofont-plus"></i>'
        $('body').find('.tocart').addClass('btn-warning')
        if($(window).width()>1180)
        {
            $('body').find('.tocart').html('В корзину')
            append = 'Добавлено'
        }

        var url = $('.cart-in-nav').attr('url')
        var parameters = {'val':'id'}
        $.when(ajax(parameters,url).then(function(data){
            data = JSON.parse(data)
            for(i in data){
                var id = data[i]
                $('body').find('.tocart[product-id="'+id+'"]').html(append)
                $('body').find('.tocart[product-id="'+id+'"]').removeClass('btn-warning')
            }
        }))
    }

    //УСТАНАВЛИВАЕТ ИНДИКАТОР КОРЗИНЫ
    function cartIndikators(data){
        var cart = $('.cart-in-nav').find('.cart-indikator')
        var count = data.total_count
        var price = data.total_price
        var indicator = ''
        if($(window).width()>755)
            indicator = 'Корзина'
        if(count!=0 || price!=0)
            indicator+=' ['+count+' ед. / '+price+' руб.]'
        cart.html(indicator)
    }

    //ПОЛУЧЕНИЕ ДАННЫХ ДЛЯ ИНДИКАТОРА КОРЗИНЫ
    function preloadIndikators(){
        var url = $('#cartpreloader').attr('url')
        var parameters = {}
        $.when(ajax(parameters,url).then(function(data){
            data = JSON.parse(data)
            cartIndikators(data)
        }))
    }

    $(document).on('click','#addorder',function(){
        if ($(this).closest('.modal').find('.cart-product .item_product').length == 0)
            alert('Ваша корзина пуста.');
        else
        {
            $(this).closest('.modal').modal('hide');
            $('#modalOrder').modal('show');
        }
    });

    //оформление заказа
    $(document).on('click','#ordermaker',function(){
        var form = $(this).closest('form')
        var url = form.attr('action')
        var parameters = form.serialize()
        $.when(ajax(parameters,url).then(function(data){
            data = JSON.parse(data)
            
            var result = '';
            $.each(data, function(index, value) {
                result += value[0] + "\n";
            });

            preloadIndikators();
            CheckProductOnCart();
            $('#modalOrder').modal('hide');
            alert(result)

        }));
    });

    preloadIndikators()
    CheckProductOnCart()

    if($(window).width()<755)
    {        
        var clone = $('.cart-in-nav').clone()
        $('.cart-in-nav').parent().html('')
        clone.find('.cart-indikator').html('')
        $('.navbar-brand').html(clone).css('font-size','14px')
    }
})