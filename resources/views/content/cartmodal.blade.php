<!-- Modal CART -->
<div class="modal fade bd-example-modal-lg" id="modalCart" url-add="{{route('cartadd')}}" url-take="{{route('carttake')}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="cart-product"></div>
        <div class="bold-price text-right">Итого: <span class="total"></span> руб.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="addorder">
            Оформить заказ
        </button>
      </div>
    </div>
  </div>
</div>