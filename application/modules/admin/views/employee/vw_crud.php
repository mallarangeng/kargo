		<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">
					<input type="hidden" name="id_employee" value="<?php echo isset($id_employee) ? $id_employee : ''?>">
					<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
					<?php $select="";?>
						<div class="widget-box transparent">
							   <?php $this->load->view('vw_button_form')?>																
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>
										<div class="form-group required">
											<label class="col-sm-4 control-label"> FIrst Name </label>
											<div class="col-sm-5">
												<input type="text" placeholder="First Name" name="firstname" class="col-xs-10 col-sm-5" value="<?php echo isset($first_name) ? $first_name : ''?>" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Last Name</label>
											<div class="col-sm-5">
												<input type="text" placeholder="Last Name" name="lastname" class="col-xs-10 col-sm-5" value="<?php echo isset($last_name) ? $last_name : ''?>">
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">Email</label>
											<div class="col-sm-5">
												<input type="email" placeholder="Email" name="email" class="col-xs-10 col-sm-5" value="<?php echo isset($email) ? $email : ''?>" required>
											</div>
										</div>
										<?php $required = isset($id_employee) ? '' : 'required'; $ignore = isset($id_employee) ? 'Ignore if not change...' : 'Password';?>
										<div class="form-group <?php echo $required?>">
											<label class="col-sm-4 control-label">Password</label>											
											<div class="col-sm-5">
												<input type="password" placeholder="<?php echo $ignore?>" name="password" class="col-xs-10 col-sm-5" <?php echo $required?>>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">Phone</label>
											<div class="col-sm-5">
												<input type="text" placeholder="Phone" name="phone" class="col-xs-10 col-sm-5" value="<?php echo isset($phone) ? $phone : ''?>" required>
											</div>
										</div>										
										<div class="form-group required">
											<label class="col-sm-4 control-label">Group</label>
											<div class="col-sm-3">
												<select class="chosen-select form-control" name="group" data-placeholder="Choose a Group..." required>
													<option value="" />
													<?php foreach ($group as $row){
														if (isset($id_employee)){$select = ($code_group == $row->code_group) ? 'selected' : '';}
														echo '<option value="'.$row->code_group.'" '.$select.'>'.$row->name_group.'</option>';
													}?> 															
												</select>
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
										<div class="form-group">
											<label class="col-sm-4 control-label">Photo</label>
											<div class="col-sm-3">
												<input type="file" class="input-file" name="photo">
												<div class="space-6"></div>
												<?php if (isset($photo)){?>
													<img style="width:150px" src="<?php echo base_url()?>assets/images/avatars/<?php echo $photo?>">
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