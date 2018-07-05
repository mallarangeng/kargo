	<div class="main-content">
		<div class="main-content-inner">							
			<div class="row">
				<div class="col-xs-12">	
					<form class="form-horizontal" id="<?php echo $id_form?>" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>#detail_table">										
						<input type="hidden" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">		
						<input type="hidden" name="id_order_detail" value="<?php echo isset($id_order_detail) ? $id_order_detail : ''?>">
						<div class="widget-box transparent">
							  <?php $this->load->view('vw_button_form');$select="";?>							  
								<div class="row">
									<div class="col-sm-6">
										<div class="space-6"></div>
										<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-8">
													<div class="widget-box transparent">
														<div class="widget-header widget-header-small">
															<h4 class="widget-title blue smaller">
																<i class="ace-icon fa fa-briefcase grey"></i>
																General Entry
															</h4>													
														</div>													
													</div>
												</div>
											</div>		
											<div class="form-group required">
												<label class="col-sm-4 control-label"> ID Order</label>
												<div class="col-sm-8">
													<input type="text" name="id_order" class="col-xs-12 col-sm-12"  value="<?php echo $id_order?>" readonly required/>																																				
												</div>
											</div>	
											<?php if ($id_form == 'form-ajax'){?>											
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Customer </label>
												<div class="col-sm-6">
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
												<label class="col-sm-4 control-label"> Label Dest </label>
												<div class="col-sm-6">
													<select class="chosen-select form-control" id="labeldest" name="labeldest" data-placeholder="Choose a Label Dest..." onchange="ajaxcall('<?php echo base_url(MODULE.'/transaction/show_form')?>',this.value)" required>
													<option value="" />
														<?php foreach ($label_dest as $row){
															if (isset($id_label_dest)){$select = ($id_label_dest == $row->id_label_dest) ? 'selected' : '';}
															echo '<option value="'.$row->id_label_dest.'" '.$select.'>'.$row->label_dest_name.'</option>';
														}?>														
												</select>
												</div>
											</div>	
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Airlines </label>
												<div class="col-sm-8">
													<select class="chosen-select form-control" id="airline" name="airline" data-placeholder="Choose a Airlines..." required>
														<option value="" />
															<?php foreach ($airline as $row){
																if (isset($id_airline)){$select = ($id_airline == $row->id_airline) ? 'selected' : '';}
																echo '<option value="'.$row->id_airline.'#'.$row->call_sign.'" '.$select.'>'.$row->call_sign.' - '.$row->airline_name.'</option>';
															}?>														
													</select>
												</div>
											</div>	
												
											<div id="formpos">
												<?php //$this->load->view('transaction/vw_form_ptpos')?>
											</div>	
											<div id="formawb">
												
											</div>									
											
											<div class="form-group">
												<label class="col-sm-4 control-label"></label>	
												<div class="col-sm-8">
													<div class="widget-box transparent">
														<div class="widget-header widget-header-small">
															<h4 class="widget-title blue smaller">
																<i class="ace-icon fa fa-barcode pink"></i>
																Label Qty Print
															</h4>													
														</div>													
													</div>
												</div>
											</div>													
											<div class="form-group required">
												<label class="col-sm-4 control-label"> Qty </label>
												<div class="col-sm-6">
													<input type="text" placeholder="Qty From" id="qtyfrom" name="qtyfrom" class="col-xs-10 col-sm-3 clear" onkeypress="return decimals(event,this.id)" value="<?php echo isset($qty_from) ? $qty_from : ''?>" required/>													
													<input type="text" placeholder="Qty To" id="qtyto" name="qtyto" class="col-xs-10 col-sm-3 clear" onkeypress="return decimals(event,this.id)" value="<?php echo isset($qty_print) ? $qty_print : ''?>" required/>
												</div>
											</div>	
											<?php if (!isset($id_order_detail)){?>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Tester</label>
												<div class="col-sm-4">
													<label>
														<input name="tester" class="ace ace-switch ace-switch-5" type="checkbox"/>
														<span class="lbl"></span>
													</label>
												</div>
											</div>	
											<?php }?>
									</div>
									<div class="col-sm-6">
										<div class="space-6"></div>
										<div id="formhawb">
											
											</div>	
											
											<div id="formother">																			
												
											</div>												
										</div>
									</div>
								<div class="required"><label>required field</label>	</div>							
						</div>																	
				  </form>				
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(){
	
	$("#airline").on('change',function(){
		var value = $(this).val();
		var x = value.split('#');
		document.getElementById('noawb').value = x[1];
		document.getElementById('noawb-print').innerHTML = '';		
	});
	
});

</script>