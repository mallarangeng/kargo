												<div class="form-group">
													<label class="col-sm-4 control-label"></label>	
													<div class="col-sm-8">
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h4 class="widget-title blue smaller">
																	<i class="ace-icon fa fa-rss orange"></i>
																	AWB Entry
																</h4>													
															</div>													
														</div>
													</div>
												</div>	
												<div class="form-group required">
													<label class="col-sm-4 control-label"> No. AWB </label>
													<div class="col-sm-8">
														<input type="text" placeholder="No. AWB" id="noawb" name="noawb" class="col-xs-10 col-sm-8 clear"  value="<?php echo isset($awb_no) ? $awb_no : ''?>" onkeypress="return decimals(event,this.id)" required/>												
														<H3 id="noawb-print" style="display:none"><br><?php echo isset($awb_no) ? substr_awb($awb_no)['subnumber1'].' '.substr_awb($awb_no)['subnumber2'] : ''?></H3>					
													</div>
												</div>	
												<div class="form-group required">
													<label class="col-sm-4 control-label"> Destination </label>
													<div class="col-sm-6">
														<input type="text" placeholder="Destination" name="awbdest" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($awb_dest) ? $awb_dest : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()" required/>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> PCS </label>
													<div class="col-sm-6">
														<input type="text" placeholder="PCS" name="awbpcs" class="col-xs-10 col-sm-3 clear"  onkeypress="return decimals(event,this.id)" value="<?php echo isset($awb_pcs) ? $awb_pcs : ''?>"/>
													</div>
												</div>	