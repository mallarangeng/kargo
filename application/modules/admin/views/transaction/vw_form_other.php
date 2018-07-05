<div class="form-group">
													<label class="col-sm-4 control-label"></label>	
													<div class="col-sm-8">
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h4 class="widget-title blue smaller">
																	<i class="ace-icon fa fa-flag red"></i>
																	Other Entry
																</h4>													
															</div>													
														</div>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> Weight </label>
													<div class="col-sm-6">
														<input type="text" placeholder="Weight" id="weight" name="weight" class="col-xs-10 col-sm-3 clear" onkeypress="return decimals(event,this.id)" value="<?php echo isset($weight) ? $weight : ''?>"/>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> VIA </label>
													<div class="col-sm-6">
														<input type="text" placeholder="VIA" name="via" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($via) ? $via : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> OFFLOAD </label>
													<div class="col-sm-6">
														<input type="text" placeholder="Offload" name="offload" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($offload) ? $offload : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
													</div>
												</div>	
												<div class="form-group">
													<label class="col-sm-4 control-label"> Special Handling Code</label>
													<div class="col-sm-6">
														<input type="text" placeholder="SH Code" name="spc" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($spc_handling_code) ? $spc_handling_code : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
													</div>
												</div>		