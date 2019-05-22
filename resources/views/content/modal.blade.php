<!-- MESSAGE MODAL -->
<div class="modal fade bd-example-modal-lg" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="messageModalLongTitle">{{ SiteInfo::getInfo()->name }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

			</div>

			<div class="modal-footer">
				<div class="col-3 p-0">
					<button type="button" class="btn btn-dark btn-block" data-dismiss="modal">Ок</button>			
				</div>
			</div>
		</div>

	</div>
</div>

<div class="loader-wrapper" style="display: none; padding: 20px 0px;">
	<div class="loader">
		<div class="inner one"></div>
		<div class="inner two"></div>
		<div class="inner three"></div>
	</div>
</div>
