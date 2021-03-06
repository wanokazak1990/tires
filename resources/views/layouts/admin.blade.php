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

    
    <title>
      {{isset($title)?$title:''}}
    </title>
    <style>
      .admin-editor img{width: 100%;}
      .admin-icon{font-size: 30px;}
      .content-list{}
      .table td{vertical-align: middle !important;}
      .content-list .content-block{
        height: 200px;
        overflow: hidden;
      }
      .content-list .content-img{
        height: inherit;
        background-size: cover !important;
        background-position: center !important;
        filter: grayscale(0.8);
        transition: transform 0.3s linear, filter 0.3s linear;
      }
      .content-list .content-img:hover{
        transform: scale(1.1,1.1);
        filter: grayscale(0);
      }
      .content-list a{
        display: block;width: 100%;height: inherit;color: #dda;text-decoration: none;text-align: center;
      }
      .content-title{
        background: #000;color:#dda;width: 100%;
      }
      .content-del{
        color:red !important;
        /*position: absolute;
        top: 0px;
        right: 10px;
        z-index: 100;
        display: inline !important;
        width: auto !important;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;*/
      }
      .content-del:hover{
        color: #a88 !important;
      }
      .product-stock img{
        width: 100px;
        height: auto;
      }
      .product-stock .product-table{
        font-size: 12px;
      }
      .product-stock .product-table td{
        border: 0px !important;
        padding: 0px;
        padding-right: 10px;
      }
      .search_product label{
        margin: 0px;padding: 0px;font-size: 12px;
      }
      textarea{width: 100%;}
    </style>
  </head>
  <body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="{{route('admin')}}">
      <img src="/assets/images/logo.jpg" width="50" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbarNavAltMarkup" aria-controls="adminNavbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="adminNavbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link {{ $infoActive or '' }}" href="{{route('infoindex')}}">Основные настройки</a>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="contentNavbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Контент
          </a>
          <div class="dropdown-menu" aria-labelledby="contentNavbarDropdown">
            <a class="dropdown-item {{ $sliderlistActive or '' }}" href="{{route('sliderlist')}}">Слайдер</a>
            <a class="dropdown-item {{ $pagesActive or '' }}" href="{{route('pageindex')}}">Страницы сайта</a>
            <a class="dropdown-item {{ $serviceActive or '' }}" href="{{route('serviceindex')}}">Сервис</a>
            <a class="dropdown-item {{ $newslistActive or '' }}" href="{{route('newlist')}}">Новости</a>
            <a class="dropdown-item {{ $feedbackActive or '' }}" href="{{route('feedbacklist')}}">Отзывы</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="productsNavbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Товары
          </a>
          <div class="dropdown-menu" aria-labelledby="productsNavbarDropdown">
            <a class="dropdown-item {{ $categoryActive or '' }}" href="{{route('catlist')}}">Категории</a>
            <a class="dropdown-item {{ $attributeActive or '' }}" href="{{route('attrlist')}}">Атрибуты</a>
            <a class="dropdown-item {{ $productActive or '' }}" href="{{route('tovarlist')}}">Продукты</a>
          </div>
        </li>
        
        <a class="nav-item nav-link {{ $clientActive or '' }}" href="{{route('clientindex')}}">Клиенты</a>
        <a class="nav-item nav-link {{ $orderActive or '' }}" href="{{route('orderindex')}}">Заказы</a>
        <a class="nav-item nav-link {{ $serviceClientActive or '' }}" href="{{route('serviceclientindex')}}">Записи</a>
        <a class="nav-item nav-link {{ $actionActive or '' }}" href="{{route('actionindex')}}">Акции</a>
        <a class="nav-item nav-link text-warning" href="{{route('main')}}" target="_blank">Перейти в магазин</a>
      </div>
      @if(isset(Auth::user()->name))
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выход
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
      @endif
    </div>
  </nav>
@show

<section class="content">
  <div class="container">
    <div class="row">
      @section('content')

      @show
    </div>
  </div>
</section>

@include('content.modal')

  <script src="{{ asset('/assets/js/jquery.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="{{asset('/assets/js/function.js')}}"></script>
  <script type="text/javascript" src="{{asset('/assets/lib/ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript">
    if($("#editor").length>0)
       CKEDITOR.replace( 'editor');
  </script>
    <!--script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
    <script type="text/javascript">
      bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script-->

  <script>
    $(document).on('click','.content-del',function(){
      var button = $(this)
      var parent = button.closest('.content-item')
      var url = button.attr('url')
      var parameters = {'id':button.attr('data-id'),'_method':'delete'}
      var input = confirm('Вы уверены, что хотите удалить это?')
      if(input)
      {
        $.when(ajax(parameters,url).then(function(data){
          if(data=='1')
            parent.remove()
        }))
      }
    })

    $(document).on('click','.add-value',function(){
      let button = $(this)
      let origin = button.closest('.value-wrapper')
      let clone = origin.clone()
      clone.find('.add-value').remove()
      origin.before(clone)
      origin.find('[type="text"]').val('')
      origin.find('[type="checkbox"]').prop('checked',false)
    })

    $(document).on('click','.del-value',function(){
      let button = $(this)
      let parent = button.closest('.value-wrapper')
      if(parent.find('.add-value').length){
        parent.find('[type="text"]').val('')
        parent.find('[type="checkbox"]').prop('checked',false)
      }
      else{
        parent.remove()
      }
    })

    $(document).on('click','#submit-attr',function(){
      var parent = $(this).closest('.admin-editor')
      var name = parent.find('[name="name"]').val()
      var category_id = parent.find('[name="category_id"]').val()
      var status = parent.find('[name="status"]')
      var attr = {
        'name' : name,
        'category_id' : category_id,
      }
      if(status.prop('checked')==true)
        attr.status = 1
      else
        attr.status = 0
      var values = []
      parent.find('.value-wrapper').each(function(){
        var line = $(this)
        var obj = {
          'value' : line.find('[name="p_values[]"]').val(),
        }

        if(line.find('[name="p_status[]"]').prop('checked')==true)
          obj.status = 1
        else
          obj.status = 0
        
        if(line.attr('data-id'))
          obj.id = line.attr('data-id')
        else
          obj.id = ''

        if(obj.value!='')
          values.push(obj)
      })
      attr.values = values
      var url = parent.find('form').attr('action')
      $.when(ajax(attr,url).then(function(data){
        document.location.href = data
      }))
    })

    $(document).on('change','#category_id',function(){
      var category = $(this).val()

      $('.product-attr').find('select').
        prop('disabled',true).
        parent().
        css('display','none')

      $('.product-attr').find('select').each(function(){
        var select = $(this)
        select.prop('selectedIndex', 0)
        if(select.attr('data-category')==category)
          select.prop('disabled',false).parent().css('display','block')
      })
    })

    $(document).on('click','[name="clear"]',function(event){
      event.preventDefault();
      var form = $(this).closest('form')
      form.find('[type="text"]').val('')
      form.find('select').prop('selectedIndex', 0)
      form.append('<input type="hidden" name="clear" value="1">')
      form.submit()
    })

    $(document).on('change','.product-category',function(){
      let url = $(this).attr('url')
      let parameters = {'category_id':$(this).val()}
      $.when(ajax(parameters,url).then(function(data){
        data = JSON.parse(data)
        $('.parameters').html('')
        $('.parameters').append('<table>')
        for(i in data){
          let obj = data[i]
          let attr_name = obj.name

          let opt = ''
          for(k in obj.values){
            let val = obj.values[k]
            opt+='<option value="'+val.id+'">'+val.value+'</option>'
          }
          let select = '<select style="width:100%;" name="attr['+obj.id+']">'+opt+'</select>'
          $('.parameters').append('<tr><td>'+attr_name+'</td><td>'+select+'</td></tr>')
        }
        $('.parameters').append('</table>')
      }))
    });

    $(document).on('click', '#showProfit', function() {
      $(this).blur();

      var datefrom = $('#profit_date_from').val();
      var dateto = $('#profit_date_to').val();

      if (datefrom == '' || dateto == '')
        alert('Для рассчета полученной прибыли необходимо задать интервал дат.');
      else
      {
        var url = $(this).attr('data-url');
        var parameters = {
          'datefrom':datefrom, 
          'dateto':dateto
        };

        $.when(ajax(parameters, url)).then(function(data) {
          $('#profit').html(data);
        });
      }
    });
  </script>

</body>
</html>