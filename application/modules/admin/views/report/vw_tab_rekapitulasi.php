										<form class="form-horizontal" method="post" target="_blank" action="<?php echo base_url(MODULE.'/tesprint/rekap_report/'.$idtab)?>">	
												<h4 class="row header smaller lighter purple">
													<span class="col-sm-10"> <?php echo $title?> </span>
												</h4>
													<?php if (isset($byshift)){?>		
													<div class="form-group">												
														<label class="col-sm-4 control-label"> Filter by Shift </label>
														<div class="col-sm-7">																																											
															<select id="shift" class="multiselect" name="shift<?php echo $idtab?>[]">															
																<?php foreach ($shift as $row){
																	echo '<option value="'.$row->id_shift.'">'.$row->shift_name.' ('.time_short($row->time_from).'-'.time_short($row->time_to).')</option>';
																}?>														
															</select>															
														</div>
													</div>			
													<?php }?>											
													<div class="form-group">
														<label class="col-sm-4 control-label">Filter by Date </label>
														<div class="col-sm-3">
															<div class="input-daterange input-group">
																<input type="text" class="date-picker input-sm form-control" name="from<?php echo $idtab?>" placeholder="Date From" data-date-format="yyyy-mm-dd" />																
																	<span class="input-group-addon">
																		<i class="fa fa-exchange"></i>
																	</span>
																	<input type="text" class="date-picker input-sm form-control" name="to<?php echo $idtab?>" placeholder="Date To" data-date-format="yyyy-mm-dd"/>																
															</div>
														</div>
													</div>	
													
													<div class="form-group">
														<label class="col-sm-4 control-label"></label>
														<div class="col-sm-3">
															<button class="btn btn-sm btn-primary btn-white btn-round" type="submit">
																<i class="ace-icon glyphicon glyphicon-print bigger-150 middle orange2"></i>
																<span class="bigger-110">Print</span>
																<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
															</button>
														</div>
													</div>	
											</form>											