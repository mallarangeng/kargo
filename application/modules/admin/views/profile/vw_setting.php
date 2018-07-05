									<div class="modal-dialog">
										<div class="modal-content" style="width:800px;top:10%;left:50%;margin-left:-400px;">											
											<div class="modal-body">												
												<?php $this->load->view('vw_alert_notif')?>	
												<form id="<?php echo $id_form?>" class="form-horizontal" value="<?php echo base_url(MODULE.'/'.$class.'/save_setting')?>">													
													 <?php $this->load->view('vw_button_form')?>
													 <input type="hidden" value="<?php echo $password?>" name="token">
													 <div class="widget-body">
														<div class="widget-main padding-6 no-padding-left no-padding-right">
															<div class="space-6"></div>
																<div class="form-group required">
																	<label class="col-sm-4 control-label">Old Password</label>
																	<div class="col-sm-8">
																		<input type="password" name="oldpassword" placeholder="Old Password" class="col-sm-5" required>
																	</div>
																</div>
																<div class="form-group required">
																	<label class="col-sm-4 control-label">New Password</label>
																	<div class="col-sm-8">
																		<input type="password" name="newpass" placeholder="New Password" class="col-sm-5" required>
																	</div>
																</div>
																<div class="form-group required">
																	<label class="col-sm-4 control-label">Re Password</label>
																	<div class="col-sm-8">
																		<input type="password" name="repass" placeholder="Re Password" class="col-sm-5" required>
																	</div>
																</div>
																												
														</div>
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Close
												</button>												
											</div>
										</div>
									</div>
									