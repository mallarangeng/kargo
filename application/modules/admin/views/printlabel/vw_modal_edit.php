				
									<div class="modal-dialog">
										<div class="modal-content" style="width:800px;top:10%;left:50%;margin-left:-400px;">											
											<div class="modal-body">																							
												<?php 
													$this->load->view('vw_alert_notif');
													$priv = $this->m_admin->get_priv($access_code,'edit');
													if (empty($priv))
													$this->load->view('transaction/vw_transaction_crud');
													else 
													echo '<div class="alert alert-warning">'.$priv['notif'].'</div>';
												?>	
											</div>
											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Close
												</button>												
											</div>
										</div>
									</div>
									