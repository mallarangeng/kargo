				
									<div class="modal-dialog">
										<div class="modal-content" style="width:800px;top:10%;left:50%;margin-left:-400px;">											
											<div class="modal-body">												
												<?php $this->load->view('vw_alert_notif')?>	
												<form id="<?php echo $id_form?>" class="form-horizontal" value="<?php echo base_url(MODULE.'/'.$class.'/print_select')?>">													
													 <?php $this->load->view('vw_button_form')?>	
													 <div class="widget-body">
														<div class="widget-main padding-6 no-padding-left no-padding-right">
															<div class="space-6"></div>
															<h5>Select and check barcode number and click save for print barcode.</h5>
															<table id="simple-table" class="table  table-bordered table-hover">
																<thead>
																	<tr>
																		<th>#</th>
																		<th class="center">
																			Check
																		</th>
																		<th class="center">Barcode Number</th>																		
																	</tr>
																	</thead>
																	<tbody>
																	<?php
																	$no=1;
																	 foreach ($sql as $row){
																		echo '<tr>
																				<td>'.$no++.'</td>
																				<td class="center">
																					<label class="pos-rel">
																						<input type="checkbox" class="ace" name="idbarcode[]" value="'.$row->id_barcode.'"/>
																						<span class="lbl"></span>
																					</label>
																				</td>							
																				<td class="center">'.$row->barcode_no.'</td>																																	
																			</tr>';
																	}?>																		
																	</tbody>
																	</table>
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
									