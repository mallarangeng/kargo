					<form class="form-horizontal" id="<?php echo $id_form?>" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>#detail_table">										
						<input type="hidden" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">		
						<input type="hidden" name="id_order_detail" value="<?php echo isset($id_order_detail) ? $id_order_detail : ''?>">
						<div class="widget-box transparent">
							  <?php $this->load->view('vw_button_form');$select="";?>							  
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>
											<div class="form-group required">
												<label class="col-sm-4 control-label"> ID Order</label>
												<div class="col-sm-3">
													<input type="text" name="id_order" class="col-xs-10 col-sm-10"  value="<?php echo $id_order?>" readonly required/>																																				
												</div>
											</div>	
											<?php if ($id_form == 'form-ajax'){?>											
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Customer </label>
												<div class="col-sm-3">
													<select class="chosen-select form-control" name="customer" data-placeholder="Choose a Customer..." required>
													<option value="" />
														<?php foreach ($customer as $row){
															echo '<option value="'.$row->id_customer.'">'.$row->complete_name.' ('.$row->id_customer.')</option>';
														}?>														
												</select>
												</div>
											</div>	
											<?php }?>
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Airlines </label>
												<div class="col-sm-3">
													<select class="chosen-select form-control" id="airline" name="airline" data-placeholder="Choose a Airlines..." required>
														<option value="" />
															<?php foreach ($airline as $row){
																if (isset($id_airline)){$select = ($id_airline == $row->id_airline) ? 'selected' : '';}
																echo '<option value="'.$row->id_airline.'#'.$row->call_sign.'" '.$select.'>'.$row->call_sign.' - '.$row->airline_name.'</option>';
															}?>														
													</select>
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Label Dest </label>
												<div class="col-sm-3">
													<select class="chosen-select form-control" name="labeldest" data-placeholder="Choose a Label Dest..." required>
													<option value="" />
														<?php foreach ($label_dest as $row){
															if (isset($id_label_dest)){$select = ($id_label_dest == $row->id_label_dest) ? 'selected' : '';}
															echo '<option value="'.$row->id_label_dest.'" '.$select.'>'.$row->label_dest_name.'</option>';
														}?>														
												</select>
												</div>
											</div>		
											<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-3">
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
												<div class="col-sm-3">
													<input type="text" placeholder="No. AWB" id="noawb" name="noawb" class="col-xs-10 col-sm-8 clear"  value="<?php echo isset($awb_no) ? $awb_no : ''?>" onkeypress="return decimals(event,this.id)" required/>												
													<H3 id="noawb-print"><br><?php echo isset($awb_no) ? substr_awb($awb_no)['subnumber1'].' '.substr_awb($awb_no)['subnumber2'] : ''?></H3>					
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Destination </label>
												<div class="col-sm-3">
													<input type="text" placeholder="Destination" name="awbdest" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($awb_dest) ? $awb_dest : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()" required/>
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> PCS </label>
												<div class="col-sm-3">
													<input type="text" placeholder="PCS" name="awbpcs" class="col-xs-10 col-sm-3 clear"  onkeypress="return decimals(event,this.id)" value="<?php echo isset($awb_pcs) ? $awb_pcs : ''?>" required/>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-3">
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
												<div class="col-sm-3">
													<input type="text" placeholder="No. HAWB" id="nohawb" name="nohawb" value="<?php echo isset($hawb_no) ? $hawb_no : ''?>" class="col-xs-10 col-sm-8 clear" />
													<H3 id="nohawb-print"><br><?php echo isset($hawb_no) ? $hawb_no : ''?></H3>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> Destination </label>
												<div class="col-sm-3">
													<input type="text" placeholder="Destination" name="hawbdest" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($hawb_dest) ? $hawb_dest : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> PCS </label>
												<div class="col-sm-3">
													<input type="text" placeholder="PCS" name="hawbpcs" class="col-xs-10 col-sm-3 clear" value="<?php echo isset($hawb_pcs) ? $hawb_pcs : ''?>" onkeypress="return decimals(event,this.id)"/>
												</div>
											</div>		
											<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-3">
													<div class="widget-box transparent">
														<div class="widget-header widget-header-small">
															<h4 class="widget-title blue smaller">
																<i class="ace-icon fa fa-barcode pink"></i>
																Label Qty
															</h4>													
														</div>													
													</div>
												</div>
											</div>													
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Qty </label>
												<div class="col-sm-3">
													<input type="text" placeholder="Qty" id="qty" name="qty" class="col-xs-10 col-sm-3 clear" onkeypress="return decimals(event,this.id)" value="<?php echo isset($qty_print) ? $qty_print : ''?>" required/>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-3">
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
												<div class="col-sm-3">
													<input type="text" placeholder="Weight" id="weight" name="weight" class="col-xs-10 col-sm-3 clear" onkeypress="return decimals(event,this.id)" value="<?php echo isset($weight) ? $weight : ''?>"/>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> VIA </label>
												<div class="col-sm-3">
													<input type="text" placeholder="VIA" name="via" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($via) ? $via : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> OFFLOAD </label>
												<div class="col-sm-3">
													<input type="text" placeholder="Offload" name="offload" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($offload) ? $offload : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> Special Handling Code</label>
												<div class="col-sm-3">
													<input type="text" placeholder="SH Code" name="spc" class="col-xs-10 col-sm-5 clear" value="<?php echo isset($spc_handling_code) ? $spc_handling_code : ''?>" onkeyup="javascript:this.value=this.value.toUpperCase()"/>
												</div>
											</div>						
									 </div>
								</div>
						</div>																	
				  </form>
<script>
$(document).ready(function(){
	$("#airline").on('change',function(){
		var value = $(this).val();
		var x = value.split('#');
		document.getElementById('noawb').value = x[1];
		document.getElementById('noawb-print').innerHTML = '';		
	});
	$("#noawb").on('keyup',function(){
		var value = $(this).val();
		var noformat = awbformat(value);
		document.getElementById('noawb-print').innerHTML = '<br>'+noformat;
	})
	$("#nohawb").on('keyup',function(){
		var value = $(this).val().toUpperCase();
		$(this).val(value);		
		document.getElementById('nohawb-print').innerHTML = '<br>'+value;
	})
});

</script>