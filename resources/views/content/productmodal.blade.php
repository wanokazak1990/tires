<!-- Modal PRODUCT -->
<div class="modal fade bd-example-modal-lg" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="container-fluid">
            <div class="row d-flex modal-product">
                <div class="col-12 col-sm-4 align-self-center">
                    <img id="main-img" src="">
                </div>
                <div class="col-12 col-sm-8 align-self-center">
                    <div>
                        <table id="product-attributes"></table>
                        <div class="row mt-3">
                            <div class="text-left price col-6">
                                Цена <span id="price">4400</span> <i class="icofont-rouble"></i>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-warning tocart" url="{{route('cartadd')}}" product-id="">В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 description"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Закрыть
        </button>
      </div>
    </div>
  </div>
</div>