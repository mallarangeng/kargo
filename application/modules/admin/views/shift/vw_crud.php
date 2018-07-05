		<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">
					<input type="hidden" name="id_shift" value="<?php echo isset($id_shift) ? $id_shift : ''?>">
					<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
					<?php $select=""; $disabled = isset($id_shift) ? 'disabled' : ''?>
						<div class="widget-box transparent">
							   <?php $this->load->view('vw_button_form')?>																
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">ID Shift</label>
											<div class="col-sm-5">
												<input type="text" <?php echo $disabled?> placeholder="ID Shift" name="id" class="col-xs-10 col-sm-5" value="<?php echo isset($id_shift) ? $id_shift : ''?>" required>
											</div>
										</div>	
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Shift Name </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Shift Name" name="name" class="col-xs-10 col-sm-5" value="<?php echo isset($shift_name) ? $shift_name : ''?>" required/>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">Time From</label>
											<div class="col-sm-5">
												<input type="text" id="timepicker1" placeholder="Time From" name="timefrom" class="col-xs-10 col-sm-2" value="<?php echo isset($time_from) ? time_short($time_from) : ''?>" required>
											</div>
										</div>										
										<div class="form-group required">
											<label class="col-sm-4 control-label">Time To</label>
											<div class="col-sm-5">
												<input type="text" id="timepicker2" placeholder="Time To" name="timeto" class="col-xs-10 col-sm-2" value="<?php echo isset($time_to) ? time_short($time_to) : ''?>" required>
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