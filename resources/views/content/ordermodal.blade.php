<!-- Modal CART -->
<div class="modal fade bd-example-modal-lg" id="modalOrder" url-add="{{route('cartadd')}}" url-take="{{route('carttake')}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      {{Form::open(['url'=>route('order')])}}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Оформление заказа</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">

          <div class="col-12 col-sm-12 col-md-6">
            <div>
              {{Form::label('name','Ваше имя:')}}
            </div>
            <div>
              {{Form::text('name','',['class'=>'form-control'])}}
            </div>
          </div>

          <div class="col-12 col-sm-12 col-md-6">
            <div>
              {{Form::label('phone','Ваш телефон:')}}
            </div>
            <div>
              {{Form::text('phone','',['class'=>'form-control'])}}
            </div>
          </div>

          <div class="col-12 col-sm-12 col-md-6">
            <div>
              {{Form::label('mail','Ваш e-mail:')}}
            </div>
            <div>
              {{Form::text('mail','',['class'=>'form-control'])}}
            </div>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="ordermaker">
            Заказать
        </button>
      </div>
      {{Form::close()}}
    </div>
  </div>
</div>