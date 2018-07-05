		<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">
					<input type="hidden" name="id_customer" value="<?php echo isset($id_customer) ? $id_customer : ''?>">					
					<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
					<?php $select="";?>																	
						<div class="widget-box transparent">
							   <?php $this->load->view('vw_button_form')?>																
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>												
												<div class="form-group required">
													<label class="col-sm-4 control-label"> Complete Name </label>
													<div class="col-sm-8">
														<input type="text" placeholder="Complete Name"  name="completename" class="col-xs-10 col-sm-5" value="<?php echo isset($complete_name) ? $complete_name : ''?>" required/>
													</div>
												</div>												
												<div class="form-group">
													<label class="col-sm-4 control-label"> Email </label>
													<div class="col-sm-8">
														<input type="email" placeholder="Email"  autocomplete="off" name="email" class="col-xs-10 col-sm-5" value="<?php echo isset($email) ? $email : ''?>"/>
													</div>
												</div>											
																															
												<div class="form-group">
													<label class="col-sm-4 control-label"> Phone </label>
													<div class="col-sm-8">
														<input type="text" placeholder="Phone"  name="phone" class="col-xs-10 col-sm-5" value="<?php echo isset($phone) ? $phone : ''?>"/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label"> Address </label>
													<div class="col-sm-8">
														<textarea name="address" id="address" class="textareas"><?php echo isset($address) ? $address : ''?></textarea>
													</div>
												</div>		
												<div class="form-group">
													<label class="col-sm-4 control-label">Active</label>
													<div class="col-sm-5">
														<label>
															<?php if (isset($active)){$select = ($active == 1) ? 'checked' : '';}?>
															<input class="ace ace-switch ace-switch-5" name="active" <?php echo $select?> type="checkbox">
														<span class="lbl"></span>
														</label>
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