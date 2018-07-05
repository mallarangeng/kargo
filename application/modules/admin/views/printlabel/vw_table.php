					<?php foreach ($detail as $row){?>
							<div class="row">
								<div class="col-xs-12 col-md-2 center">
											<span class="profile-picture">											
												<img class="editable img-responsive editable-click editable-empty" alt="<?php echo $row->logo?>" id="avatar" src="<?php echo base_url()?>assets/images/airline_logo/<?php echo $row->logo?>" />
											</span>	
											<div class="space-4"></div>
											<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
												<span class="white middle bigger-120"><?php echo $row->airline_name?></span>														
											</div>										
								</div><!--/span-->
								<div class="col-md-5">
									
									<div class="space-12"></div>
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Airway Bill No </div>

													<div class="profile-info-value">
														<span class="editable"><?php echo substr_awb($row->awb_no)['subnumber1'].' '.substr_awb($row->awb_no)['subnumber2']?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Destination </div>

													<div class="profile-info-value">
														<i class="fa fa-map-marker light-orange bigger-110"></i>
														<span class="editable" id="country"><?php echo $row->awb_dest?></span>														
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Total Pcs </div>

													<div class="profile-info-value">
														<span class="editable" id="age"><?php echo $row->awb_pcs?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> HAWB No </div>

													<div class="profile-info-value">
														<span class="editable"><?php echo $row->hawb_no?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Destination </div>

													<div class="profile-info-value">
														<i class="fa fa-map-marker light-orange bigger-110"></i>
														<span class="editable" id="country"><?php echo $row->hawb_dest?></span>													
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Total Pcs </div>

													<div class="profile-info-value">
														<span class="editable" id="age"><?php echo $row->hawb_pcs?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> ID Airline </div>

													<div class="profile-info-value">
														<span class="editable" id="signup"><?php echo $row->id_airline?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Call Sign </div>

													<div class="profile-info-value">
														<span class="editable" id="signup"><?php echo $row->call_sign?></span>
													</div>
												</div>	
												<div class="profile-info-row">
													<div class="profile-info-name"> Airline Name </div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php echo $row->airline_name?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Label Destination</div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php echo $row->label_dest_name?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> VIA</div>

													<div class="profile-info-value">
														<span class="editable" id="via"><?php echo $row->via?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Offload</div>
													<div class="profile-info-value">
														<span class="editable" id="offload"><?php echo $row->offload?></span>
													</div>
												</div>
											</div>
									</div>
									<div class="col-md-5">
										<div class="space-12"></div>
											<div class="profile-user-info profile-user-info-striped">	
												<div class="profile-info-row">
													<div class="profile-info-name"> Label Cost Name </div>

													<div class="profile-info-value">
														<span class="editable" id="about"><?php echo $row->name_cost?></span>
													</div>
												</div>											
												<div class="profile-info-row">
													<div class="profile-info-name"> Qty Print </div>

													<div class="profile-info-value">
														<span class="editable" id="signup"><?php echo $row->qty_print?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Unit Price </div>

													<div class="profile-info-value">
														<span class="editable" id="signup"><?php echo ISOCODE.' '.number_format($row->price,0)?></span>
													</div>
												</div>	
												<div class="profile-info-row">
													<div class="profile-info-name"> Subtotal Price </div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php echo ISOCODE.' '.number_format($row->subtotal_price,0)?></span>
													</div>
												</div>												
												<div class="profile-info-row">
													<div class="profile-info-name"> Unit Price Inc Tax </div>

													<div class="profile-info-value">
														<span class="editable" id="about"><?php echo ISOCODE.' '.number_format($row->price_tax)?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Subtotal Price Inc Tax </div>

													<div class="profile-info-value">
														<span class="editable" id="about"><?php echo ISOCODE.' '.number_format($row->subtotal_price_tax)?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Tax 10% </div>

													<div class="profile-info-value">
														<span class="editable" id="about"><?php echo ISOCODE.' '.number_format($row->amount_tax)?></span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Origin Station </div>

													<div class="profile-info-value">
														<span class="editable" id="about"><?php echo $row->origin_station?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Weight </div>

													<div class="profile-info-value">
														<span class="editable" id="weight"><?php echo $row->weight?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Special Handling</div>
													<div class="profile-info-value">
														<span class="editable" id="spc"><?php echo $row->spc_handling_code?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Status </div>
													<div class="profile-info-value">
													<?php $status = ($row->active == 1) ? '<span class="label label-success arrowed-in-right arrowed">Active</span>' : '<span class="label label-important arrowed-in-right arrowed">Void</span>';?>
														<span class="editable" id="about"><?php echo $status?></span>
													</div>
												</div>
											</div>
	</div>
</div>
<div class="space-12"></div>
<div class="center">
	<button class="btn btn-sm btn-primary btn-white btn-round" type="button" onclick="openWin('<?php echo base_url(MODULE.'/tesprint/index/'.$row->id_order_detail)?>')">
		<i class="ace-icon fa fa-barcode bigger-150 middle orange2"></i>
		<span class="bigger-110">Print All Barcode</span>
		<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
	</button>
	<button class="btn btn-sm btn-primary btn-white btn-round" type="button" href="#modal-form" data-toggle="modal" onclick="ajaxModal('<?php echo base_url(MODULE.'/printlabel/select_print')?>','<?php echo $row->id_order_detail?>','modal-form')">
		<i class="ace-icon fa fa-barcode bigger-150 middle green"></i>
		<span class="bigger-110">Print Select Barcode</span>
		<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
	</button>
	<button class="btn btn-sm btn-primary btn-white btn-round" type="button" href="#modal-form" data-toggle="modal" onclick="ajaxModal('<?php echo base_url(MODULE.'/printlabel/edit')?>','<?php echo $row->id_order_detail?>','modal-form')">
		<i class="ace-icon glyphicon glyphicon-edit bigger-150 middle blue"></i>
		<span class="bigger-110">Edit</span>		
	</button>
</div>
<?php }?>