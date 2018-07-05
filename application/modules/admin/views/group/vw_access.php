<div class="main-content">
	<div class="main-content-inner">
		<?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">								
						<input type="hidden" name="code_group" value="<?php echo $code_group?>">		
						<input type="hidden" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">		
						<div class="widget-box transparent">
							 <?php $this->load->view('vw_header_title')?>		
							<div class="widget-body">
								<div class="widget-main padding-6 no-padding-left no-padding-right">
									<div class="space-6"></div>
									<?php $select='';?>	
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr><th>#</th>									
												<th>Moduls Name</th>
												<th class="center">
													<label>
														<?php 
														$total = $this->m_admin->total_modul(array('code_group'=>$code_group,'active'=>1));
														$checked = ($count == $total) ? 'checked' : '';
														?>
														<input type="checkbox" class="ace ace ace-checkbox-2" <?php echo $checked?> id="active-all" value="<?php echo $code_group.'#active'?>" onclick="ajaxcheck('<?php echo base_url(MODULE.'/'.$class.'/check_permission/1')?>',this.value,this)"/>
														<span class="lbl"> Active</span>
													</label>
												</th>
												<th class="center">
													<label>
													<?php 
														$total = $this->m_admin->total_modul(array('code_group'=>$code_group,'view'=>1));
														$checked = ($count == $total) ? 'checked' : '';
														?>
														<input type="checkbox" class="ace ace ace-checkbox-2" <?php echo $checked?> id="view-all" value="<?php echo $code_group.'#view'?>" onclick="ajaxcheck('<?php echo base_url(MODULE.'/'.$class.'/check_permission/1')?>',this.value,this)"/>
														<span class="lbl"> View</span>
													</label>
												</th>									
												<th class="center">
													<label>
													<?php 
														$total = $this->m_admin->total_modul(array('code_group'=>$code_group,'add'=>1));
														$checked = ($count == $total) ? 'checked' : '';
														?>
														<input type="checkbox" class="ace ace ace-checkbox-2" <?php echo $checked?> id="add-all" value="<?php echo $code_group.'#add'?>" onclick="ajaxcheck('<?php echo base_url(MODULE.'/'.$class.'/check_permission/1')?>',this.value,this)"/>
														<span class="lbl"> Add</span>
													</label>
												</th>
												<th class="center">
													<label>
													<?php 
														$total = $this->m_admin->total_modul(array('code_group'=>$code_group,'edit'=>1));
														$checked = ($count == $total) ? 'checked' : '';
														?>
														<input type="checkbox" class="ace ace ace-checkbox-2" <?php echo $checked?> id="edit-all" value="<?php echo $code_group.'#edit'?>" onclick="ajaxcheck('<?php echo base_url(MODULE.'/'.$class.'/check_permission/1')?>',this.value,this)"/>
														<span class="lbl"> Edit</span>
													</label>
												</th>
												<th class="center">
													<label>
													<?php 
														$total = $this->m_admin->total_modul(array('code_group'=>$code_group,'delete'=>1));
														$checked = ($count == $total) ? 'checked' : '';
														?>
														<input type="checkbox" class="ace ace ace-checkbox-2" <?php echo $checked?> id="delete-all" value="<?php echo $code_group.'#delete'?>" onclick="ajaxcheck('<?php echo base_url(MODULE.'/'.$class.'/check_permission/1')?>',this.value,this)"/>
														<span class="lbl"> Delete</span>
													</label>
												</th>
												<th>Function</th>
										</thead>
										<tbody>
											<?php $no=1;
											foreach ($modul_parent as $row){
												$active = ($row->active == 1) ? 'checked' : '';
												echo '<tr><td>'.$no++.'</td>
														  <td><i class="'.$row->icon.'"></i> '.$row->name.'</td>
														  <td class="center">
																<label>
																	<input type="checkbox" class="ace ace-checkbox-2 active-row" '.$active.' onclick="ajaxcheck(\''.base_url(MODULE.'/'.$class.'/check_permission/0').'\',\''.$row->id_priv.'#active\',this)"/>
																	<span class="lbl"> Active</span>
																</label>
															</td>
														<td colspan=5></td>
													</tr>';														
												$where = array('A.id_modul_parent'=>$row->id_modul,'B.code_group'=>$code_group);
												$sub_modul = $this->m_admin->get_modul($where);
												foreach ($sub_modul as $val){	
												    $active = ($val->active == 1) ? 'checked' : '';									
													$view = ($val->view == 1) ? 'checked' : '';
													$add = ($val->add == 1) ? 'checked' : '';
													$edit = ($val->edit == 1) ? 'checked' : '';
													$delete = ($val->delete == 1) ? 'checked' : '';
													$id_priv = $val->id_priv;
													echo '<tr><td></td>
														 	  <td><div style="margin-left:25px"><i class="ace fa fa-arrow-right"></i> '.$val->name.'</div></td>
															  <td class="center">
																<label>
																	<input type="checkbox" class="ace ace-checkbox-2 active-row" '.$active.' onclick="ajaxcheck(\''.base_url(MODULE.'/'.$class.'/check_permission/0').'\',\''.$id_priv.'#active\',this)"/>
																	<span class="lbl"> Active</span>
																</label>
															 </td>												  
															 <td class="center">
																<label>
																	<input type="checkbox" class="ace ace-checkbox-2 view-row" '.$view.' onclick="ajaxcheck(\''.base_url(MODULE.'/'.$class.'/check_permission/0').'\',\''.$id_priv.'#view\',this)"/>
																	<span class="lbl"> View</span>
																</label>
															 </td>
															<td class="center">
																<label>
																	<input type="checkbox" class="ace ace-checkbox-2 add-row" '.$add.' onclick="ajaxcheck(\''.base_url(MODULE.'/'.$class.'/check_permission/0').'\',\''.$id_priv.'#add\',this)"/>
																	<span class="lbl"> Add</span>
																</label>
															 </td>
															<td class="center">
																<label>
																	<input type="checkbox" class="ace ace-checkbox-2 edit-row" '.$edit.' onclick="ajaxcheck(\''.base_url(MODULE.'/'.$class.'/check_permission/0').'\',\''.$id_priv.'#edit\',this)"/>
																	<span class="lbl"> Edit</span>
																</label>
															 </td>											
															<td class="center">
																<label>
																	<input type="checkbox" class="ace ace-checkbox-2 delete-row" '.$delete.' onclick="ajaxcheck(\''.base_url(MODULE.'/'.$class.'/check_permission/0').'\',\''.$id_priv.'#delete\',this)"/>
																	<span class="lbl"> Delete</span>
																</label>
															 </td>
															<td><a data-toggle="modal" class="btn btn-info btn-mini" title="Access Function" href="#myModal" data-rel="tooltip" onclick="modalShow(\''.base_url('superadmin/admprofile/access_function').'\',\''.$code_group.'#'.$val->id_modul.'\',\'myModal\')">
																<i class="ace fa fa-key"></i>
																</a></td>
													  	  </tr>';
												}
											}?>
										</tbody>
									</table>				
								</div>
							</div>
						</div>																	
				  </form>
			 </div>
		  </div>
	  </div>
	</div>
</div>
<script>
$(".active-row").on('click',function(e){
	if (!this.checked){
		$("#active-all").prop('checked',false);
	}
})
$(".view-row").on('click',function(e){
	if (!this.checked){
		$("#view-all").prop('checked',false);
	}
})
$(".add-row").on('click',function(e){
	if (!this.checked){
		$("#add-all").prop('checked',false);
	}
})
$(".edit-row").on('click',function(e){
	if (!this.checked){
		$("#edit-all").prop('checked',false);
	}
})
$(".delete-row").on('click',function(e){
	if (!this.checked){
		$("#delete-all").prop('checked',false);
	}
})
$("#active-all").on('click',function(e){
	if (this.checked){
		$(".active-row").prop('checked',true);		
	}else{
		$(".active-row").prop('checked',false);		
	}
})
$("#view-all").on('click',function(e){
	if (this.checked){
		$(".view-row").prop('checked',true);
	}else{
		$(".view-row").prop('checked',false);
	}
})
$("#add-all").on('click',function(e){
	if (this.checked){
		$(".add-row").prop('checked',true);
	}else{
		$(".add-row").prop('checked',false);
	}
})
$("#edit-all").on('click',function(e){
	if (this.checked){
		$(".edit-row").prop('checked',true);
	}else{
		$(".edit-row").prop('checked',false);
	}
})
$("#delete-all").on('click',function(e){
	if (this.checked){
		$(".delete-row").prop('checked',true);
	}else{
		$(".delete-row").prop('checked',false);
	}
})
</script>