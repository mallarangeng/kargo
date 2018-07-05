		<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">
					<input type="hidden" name="id_group" value="<?php echo isset($id_group) ? $id_group : ''?>">
					<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
					<?php $select="";$disabled = isset($id_group) ? 'readonly' : ''?>
						<div class="widget-box transparent">
							   <?php $this->load->view('vw_button_form')?>																
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Code Name </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Code Name" <?php echo $disabled?> name="code" class="col-xs-10 col-sm-5" value="<?php echo isset($code_group) ? $code_group : ''?>" required/>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Group Name </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Group Name " name="name" class="col-xs-10 col-sm-5" value="<?php echo isset($name_group) ? $name_group : ''?>" required/>
											</div>
										</div>	
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Shift Schedule </label>
											<div class="col-sm-8">
												<select id="shift" class="multiselect" multiple="" name="shift[]">
														<?php foreach ($shift as $g){
															$idshifts = isset($idshift) ? $idshift : array();
															$checkshift = in_array($g->id_shift, $idshifts) ? "selected" : "";//used for post data															
															echo '<option value="'.$g->id_shift.'" '.$checkshift.'>'.$g->shift_name.' ('.time_short($g->time_from).'-'.time_short($g->time_to).')</option>';
														}?>															
														</select>
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