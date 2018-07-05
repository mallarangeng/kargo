										<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-8">
													<div class="widget-box transparent">
														<div class="widget-header widget-header-small">
															<h4 class="widget-title blue smaller">
																<i class="ace-icon fa fa-rss orange"></i>
																POS Entry
															</h4>													
														</div>													
													</div>
												</div>
											</div>
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Flight No </label>
												<div class="col-sm-8">
													<input type="text" placeholder="Flight No" id="flightno" name="flightno" class="col-xs-10 col-sm-8 clear"  value="<?php echo isset($flight_no) ? $flight_no : ''?>" required/>																		
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Date Flight </label>
												<div class="col-sm-4">
													<input type="text" class="date-picker input-sm form-control" name="dateflight" placeholder="Date Flight" data-date-format="yyyy-mm-dd"/>																
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> BC 1.1 </label>
												<div class="col-sm-8">
													<input type="text" placeholder="BC 1.1" id="bc" name="bc" class="col-xs-10 col-sm-8 clear"  value="<?php echo isset($bc_1_1) ? $bc_1_1 : ''?>" required/>
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> POS No </label>
												<div class="col-sm-8">
													<input type="text" placeholder="POS No" id="posno" name="posno" class="col-xs-10 col-sm-8 clear"  value="<?php echo isset($pos_no) ? $pos_no : ''?>" required/>
												</div>
											</div>			