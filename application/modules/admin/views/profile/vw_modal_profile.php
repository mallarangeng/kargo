									<div class="modal-dialog">
										<div class="modal-content" style="width:800px;top:10%;left:50%;margin-left:-400px;">											
											<div class="modal-body">												
												<?php $this->load->view('vw_alert_notif')?>	
												<form id="<?php echo $id_form?>" class="form-horizontal">													
													<h2>Data Profile</h2>	
													 <div class="widget-body">
														<div class="widget-main padding-6 no-padding-left no-padding-right">
															<div class="space-6"></div>															
																<div class="form-group">
																	<label class="col-sm-4 control-label">First Name</label>
																	<div class="col-sm-8">
																		<input type="text" readonly value="<?php echo $first_name?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-4 control-label">Last Name</label>
																	<div class="col-sm-8">
																		<input type="text" readonly value="<?php echo $last_name?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-4 control-label">Email</label>
																	<div class="col-sm-8">
																		<input type="text" readonly value="<?php echo $email?>" class="col-sm-8">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-4 control-label">Phone</label>
																	<div class="col-sm-8">
																		<input type="text" readonly value="<?php echo $phone?>">
																	</div>
																</div>	
																<div class="form-group">
																	<label class="col-sm-4 control-label">Group</label>
																	<div class="col-sm-8">
																		<input type="text" readonly value="<?php echo $name_group?>">
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
									