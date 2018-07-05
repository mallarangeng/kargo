		<div class="main-content">
				<div class="main-content-inner">
				 <?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																														
					<form class="form-horizontal" id="form-ajax" value="<?php echo base_url(MODULE.'/'.$class.'/proses')?>">
					<input type="hidden" name="id_cost_label" value="<?php echo isset($id_cost_label) ? $id_cost_label : ''?>">
					<input type="hidden" class="msp_token" name="<?php echo csrf_token()['name']?>" value="<?php echo csrf_token()['hash']?>">
					<?php $select="";?>
						<div class="widget-box transparent">
							   <?php $this->load->view('vw_button_form')?>																
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">
										<div class="space-6"></div>										
										<div class="form-group required">
											<label class="col-sm-4 control-label"> Name Cost </label>
											<div class="col-sm-5">
												<input type="text" placeholder="Name Cost" name="name" class="col-xs-10 col-sm-5" value="<?php echo isset($name_cost) ? $name_cost : ''?>" required/>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-4 control-label">Qty First</label>
											<div class="col-sm-5">
												<input type="text" id="qtyfirst" placeholder="Qty First" name="qtyfirst" onkeypress="return decimals(event,this.id)" class="col-xs-10 col-sm-2" value="<?php echo isset($qty_first) ? $qty_first : ''?>" required>
											</div>
										</div>										
										<div class="form-group required">
											<label class="col-sm-4 control-label">Qty Last</label>
											<div class="col-sm-5">
												<input type="text" id="qtylast" placeholder="Qty Last" name="qtylast" class="col-xs-10 col-sm-2" onkeypress="return decimals(event,this.id)" value="<?php echo isset($qty_last) ? $qty_last : ''?>" required>
											</div>
										</div>											
										<div class="form-group required">
											<label class="col-sm-4 control-label">Price</label>
											<div class="col-sm-5">
												<input type="text" id="price" placeholder="Price" name="price" class="col-xs-10 col-sm-3" value="<?php echo isset($price) ? $price : ''?>" onkeypress="return decimals(event,this.id)" required>
											</div>
										</div>	
									 </div>
								</div>
						</div>																	
				  </form>
			 </div>
		  </div>
	  </div>
	</div>
</div>