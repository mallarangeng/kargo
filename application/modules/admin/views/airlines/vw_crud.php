		<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">
					<input type="hidden" name="id_airline" value="<?php echo isset($id_airline) ? $id_airline : ''?>">
					<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
					<?php $select=""; $disabled = isset($id_airline) ? 'disabled' : ''?>
						<div class="widget-box transparent">
							   <?php $this->load->view('vw_button_form')?>																
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">ID Airline</label>
											<div class="col-sm-5">
												<input type="text" <?php echo $disabled?> placeholder="ID Airline" name="id" class="col-xs-10 col-sm-5" value="<?php echo isset($id_airline) ? $id_airline : ''?>" required>
											</div>
										</div>	
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Airline Name </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Airline Name" name="name" class="col-xs-10 col-sm-5" value="<?php echo isset($airline_name) ? $airline_name : ''?>" required/>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">Call Sign</label>
											<div class="col-sm-3">
												<input type="text" placeholder="Call Sign" id="callsign" name="callsign" class="col-xs-10 col-sm-3" value="<?php echo isset($call_sign) ? $call_sign : ''?>" onkeypress="return decimals(event,this.id)" required>
											</div>
										</div>																																										
										<div class="form-group">
											<label class="col-sm-4 control-label">Logo</label>
											<div class="col-sm-3">
												<input type="file" class="input-file" name="logo">
												<div class="space-6"></div>
												<?php if (isset($logo)){?>
													<img style="width:150px" src="<?php echo base_url()?>assets/images/airline_logo/<?php echo $logo?>">
												<?php }?>
											</div>											
										</div>	
									 </div>
								</div>
						</div>																	
				  </form>
			 </div>
		  </div>
	  </div>
	</div>
</div>