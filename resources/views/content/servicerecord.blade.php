<div class="container-fluid zapis">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 form">
                <h2 class="block-title">
                    Записаться на сервис
                </h2>
                {{Form::open(['url'=>route('record')])}}
                    <input type="text" name="name" placeholder="Ваше имя" required="" >
                    <input type="text" name="phone" placeholder="Ваш телефон" required="">
                    <input type="date" name="date" placeholder="Дата" required="">
                    <input type="time" name="time" placeholder="Время" required="">
                    <textarea  placeholder="Комментарий"></textarea>
                    <button type="button" id="service-record">Записаться</button>
                {{Form::close()}}
            </div>
            <div class="col-12 col-md-8 d-none d-sm-flex align-items-center">
                <img src="{{asset('/assets/images/imgtires.png')}}" style="height: auto; width: 100%;">
            </div>
        </div>
    </div>
</div>