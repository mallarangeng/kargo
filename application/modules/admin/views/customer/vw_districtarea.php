												<?php $id_districts = isset($id_districts) ? $id_districts : '';
													$id_cities = isset($id_cities) ? $id_cities : '';
													$id_province = isset($id_province) ? $id_province : '';
													$id_form = isset($id_form) ? $id_form : '';
													?>
												<div class="form-group required">
													<label class="col-sm-4 control-label"> Province </label>
													<div class="col-sm-3" id="province<?php echo $id_form?>">
														<?php echo $this->m_content->chosen_province($id_country,$id_province,$class,$id_form);?>
													</div>
												</div>	
												<div class="form-group required">
													<label class="col-sm-4 control-label"> City </label>
													<div class="col-sm-3" id="city<?php echo $id_form?>">
														<?php echo $this->m_content->chosen_city($id_province,$id_cities,$class,$id_form);?>
													</div>
												</div>	
												<div class="form-group required">
													<label class="col-sm-4 control-label"> Districts </label>
													<div class="col-sm-3" id="districts<?php echo $id_form?>">
														<?php echo $this->m_content->chosen_districts($id_cities,$id_districts,$class,$id_form);?>
													
													</div>
												</div>	