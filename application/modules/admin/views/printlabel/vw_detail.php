<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
					<div class="page-content">						
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php $this->load->view('vw_alert_notif')?>	
								<form class="form-horizontal" id="form-ajax">
									<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
									<div id="detail_table">
										<?php $this->load->view('printlabel/vw_table')?>
									</div>							
									
								</form>				
								
							</div>
						</div>
					</div>
				</div>
			</div>
