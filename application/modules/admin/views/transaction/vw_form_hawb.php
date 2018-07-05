												 <div class="form-group">
													<label class="col-sm-4 control-label"></label>	
													<div class="col-sm-8">
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h4 class="widget-title blue smaller">
																	<i class="ace-icon fa fa-external-link green"></i>
																	HAWB Entry
																</h4>													
															</div>
														
														</div>
													</div>
												</div>			
												<div class="form-group">
													<label class="col-sm-4 control-label"> No. HAWB </label>
													<div class="col-sm-8">
														<input type="text" placeholder="No. HAWB" id="nohawb" name="nohawb" value="<?php echo isset($hawb_no) ? $hawb_no : ''?>" class="col-xs-10 col-sm-8 clear" />
														<H3 id="nohawb-print" style="display:none"><br><?php echo isset($hawb_no) ? $hawb_no : ''?></H3>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> Destination </label>
													<div class="col-sm-6">
														<input type="text" placeholder="Destination" name="hawbdest" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($hawb_dest) ? $hawb_dest : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> PCS </label>
													<div class="col-sm-6">
														<input type="text" placeholder="PCS" name="hawbpcs" class="col-xs-10 col-sm-3 clear" value="<?php echo isset($hawb_pcs) ? $hawb_pcs : ''?>" onkeypress="return decimals(event,this.id)"/>
													</div>
												</div>		