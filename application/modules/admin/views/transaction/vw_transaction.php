<div class="main-content">
	<div class="main-content-inner">
		<?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<?php $this->load->view('transaction/vw_transaction_crud');?>				
			 </div>
		  </div>
	  </div>
	</div>
</div>
