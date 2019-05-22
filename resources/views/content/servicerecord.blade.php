<div class="container-fluid zapis">
    <div style="background: url('{{asset('/assets/images/imgtires.png')}}');background-size: contain;background-repeat: no-repeat;background-position: right;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 form">
                    <h2 class="block-title">
                        Записаться на сервис
                    </h2>
                    {{Form::open(['url'=>route('record')])}}
                        <input type="text" name="name" placeholder="Ваше имя" required="" class="form-contol">
                        <input type="text" name="phone" placeholder="Ваш телефон" required="" class="form-contol">
                        <input type="date" name="date" placeholder="Дата" required="" class="form-contol">
                        <input type="time" name="time" placeholder="Время" required="" class="form-contol">
                        <textarea name="comment" placeholder="Комментарий"></textarea>
                        <button type="button" id="service-record">Записаться</button>
                    {{Form::close()}}
                </div>
                <div class="col-12 col-md-8 d-none d-sm-flex align-items-center" style=""></div>
            </div>
        </div>
    </div>
</div>