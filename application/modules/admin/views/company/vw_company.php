<div class="main-content">
	<div class="main-content-inner">
		<?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">								
						<input type="hidden" name="id_company" value="<?php echo $id_company?>">		
						<input type="hidden" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">		
						<div class="widget-box transparent">
							  <?php $this->load->view('vw_button_form')?>	
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Station Code </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Station Code" name="statcode" class="col-xs-10 col-sm-5" value="<?php echo isset($station_code) ? $station_code : ''?>" required/>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Company Name </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Company Name" name="name" class="col-xs-10 col-sm-5" value="<?php echo isset($company_name) ? $company_name : ''?>" required/>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">Address</label>
											<div class="col-sm-4">
												<textarea name="address" placeholder="Address" class="textareas"><?php echo isset($address_company) ? $address_company : ''?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Home Phone</label>
											<div class="col-sm-5">
												<input type="text" placeholder="Home Phone" name="homephone" class="col-xs-10 col-sm-5" value="<?php echo isset($homephone_company) ? $homephone_company : ''?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Mobile Phone</label>
											<div class="col-sm-5">
												<input type="text" placeholder="Mobile Phone" name="mobilephone" class="col-xs-10 col-sm-5" value="<?php echo isset($mobilephone_company) ? $mobilephone_company : ''?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Email</label>
											<div class="col-sm-5">
												<input type="email" placeholder="Email" name="email" class="col-xs-10 col-sm-5" value="<?php echo isset($email_company) ? $email_company : ''?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Logo</label>
											<div class="col-sm-3">
												<input type="file" class="input-file" name="logo">
												<div class="space-6"></div>
											<?php if (isset($logo_company)){?>
												<img style="width:150px" src="<?php echo base_url()?>assets/images/logo/<?php echo $logo_company?>">
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