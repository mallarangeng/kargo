				
									<div class="modal-dialog">
										<div class="modal-content" style="width:800px;top:10%;left:50%;margin-left:-400px;">											
											<div class="modal-body">												
												<?php $this->load->view('vw_alert_notif')?>	
												<form id="<?php echo $id_form?>" class="form-horizontal" value="<?php echo base_url(MODULE.'/'.$class.'/save_address')?>#listaddress">
													<input type="hidden" name="id_customer" value="<?php echo isset($id_customer) ? $id_customer : ''?>">
													<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
													<input type="hidden" name="id_address" value="<?php echo isset($id_address) ? $id_address : ''?>">
													 <?php $this->load->view('vw_button_form')?>	
													 <div class="widget-body">
														<div class="widget-main padding-6 no-padding-left no-padding-right">
															<div class="space-6"></div>
															<?php $select="";
															$id_province = isset($id_province) ? $id_province : '';
															$id_country = isset($id_country) ? $id_country : '';?>	
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Alias Address Name </label>
																<div class="col-sm-8">
																	<input type="text" placeholder="Alias Address Name"  name="alias" class="col-xs-10 col-sm-5" value="<?php echo isset($alias_name) ? $alias_name : ''?>" required/>
																</div>
															</div>	
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Receiver Name</label>
																<div class="col-sm-8">
																	<input type="text" placeholder="Receiver Name"  name="namereceived" class="col-xs-10 col-sm-5" value="<?php echo isset($name_received) ? $name_received : ''?>" required/>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label"> Company </label>
																<div class="col-sm-8">
																	<input type="text" placeholder="Company"  name="company" class="col-xs-10 col-sm-5" value="<?php echo isset($company) ? $company : ''?>"/>
																</div>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Address </label>
																<div class="col-sm-8">
																	<textarea name="address" id="address" class="textareas col-xs-10 col-sm-5"><?php echo isset($address) ? $address : ''?></textarea>
																</div>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Country </label>
																<div class="col-sm-3">
																	<select class="chosen-select form-control" name="country" data-placeholder="Choose a country..." onchange="ajaxcall('<?php echo base_url(MODULE.'/'.$class.'/show_province/'.$id_form.'/'.$id_province)?>',this.value,'province<?php echo $id_form?>')" required>
																		<option value="" />
																		<?php foreach ($country as $row){
																			if (isset($id_country)){$select = ($id_country == $row->id_country) ? 'selected' : '';}																		
																			echo '<option value="'.$row->id_country.'#'.$row->country_code.'" '.$select.'>'.$row->country_name.'</option>';
																		}?> 															
																	</select>
																</div>
															</div>
															<div id="districtarea<?php echo $id_form?>">
															<?php if ($country_code == 'ID'){
																	//show for edit data
																	$this->load->view($class.'/vw_districtarea',array('id_address'=>$id_address));
																}?>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Post Code </label>
																<div class="col-sm-8">
																	<input type="text" placeholder="Post Code"  name="postcode" class="col-xs-10 col-sm-5" value="<?php echo isset($postcode) ? $postcode : ''?>" required/>
																</div>
															</div>
															<div class="form-group required">
																<label class="col-sm-4 control-label"> Phone </label>
																<div class="col-sm-8">
																	<input type="text" placeholder="Phone"  name="phoneaddr" class="col-xs-10 col-sm-5" value="<?php echo isset($phone_addr) ? $phone_addr : ''?>" required/>
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
									