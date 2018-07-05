<div class="main-content">
	<div class="main-content-inner">
		<?php $this->load->view('vw_header_form')?>
		<div class="page-content">				
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('vw_alert_notif')?>																																		
						<div class="widget-box transparent">							 		
								<div class="widget-body">
									<div class="widget-main padding-6 no-padding-left no-padding-right">										
										<div class="tabbable">
											<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="javascript:void(0)" onclick="ajaxcall('<?php echo base_url(MODULE.'/'.$class.'/index')?>','tab1','content')">
														<i class="green ace-icon fa fa-rss bigger-120"></i>
														Rekapitulasi Pendapatan Bulanan
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="javascript:void(0)" onclick="ajaxcall('<?php echo base_url(MODULE.'/'.$class.'/index')?>','tab2','content')">
														<i class="orange ace-icon fa fa-rss bigger-120"></i>
														Laporan Penerimaan Harian
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="javascript:void(0)" onclick="ajaxcall('<?php echo base_url(MODULE.'/'.$class.'/index')?>','tab3','content')">
														<i class="pink ace-icon fa fa-rss bigger-120"></i>
														Laporan Penerimaan Barcode Label dan MAWB
													</a>
												</li>												
											</ul>
											<div class="tab-content no-border padding-24">
												<div id="content" class="tab-pane fade in active">
													<?php $this->load->view('report/vw_tab_rekapitulasi')?>
												</div>																				
											</div>
										</div>										
									 </div>
								</div>
						</div>																				  
			 </div>
		  </div>
	  </div>
	</div>
</div>
