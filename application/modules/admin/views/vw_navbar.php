		<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state navbar-fixed-top">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
					<?php $photo = ($this->session->userdata('photo') == '') ? 'avatar2.png' : $this->session->userdata('photo');?>
					<a href="<?php echo base_url(MODULE)?>" class="navbar-brand">
						<small>
							<i class="fa fa-leaf green"></i>
							<span class="red"><?php echo $this->config->config['title1'].'</span> '.$this->config->config['title2']?></span>							
						</small>
					</a>
					<a href="#" class="navbar-brand">
						<small>
							<i class="ace-icon glyphicon glyphicon-refresh"></i>
							<?php echo $this->session->userdata('shift_name')?>							
						</small>
					</a>
					<a href="#" class="navbar-brand">
						<small>
							<i class="ace-icon fa fa-bell"></i>
							<?php echo time_short($this->session->userdata('time_from')).' - '.time_short($this->session->userdata('time_to'))?>
						</small>							
					</a>
					<a href="#" class="navbar-brand">
						<small>
							<i class="ace-icon fa fa-clock-o"></i>
							<span id="timerun"></span>
						</small>						
					</a>
					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>
						<img src="<?php echo base_url()?>assets/images/avatars/<?php echo $photo?>" alt="#" />
					</button>

					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>
				
				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">									
						<li class="light-blue dropdown-modal user-min">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url()?>assets/images/avatars/<?php echo $photo?>" alt="#" />
								<span class="user-info">
									<small>Welcome,
									<?php echo $this->session->userdata('first_name')?></small>
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#modal-form" data-toggle="modal" onclick="ajaxModal('<?php echo base_url(MODULE.'/profile/form/true')?>','','modal-form')">
										<i class="ace-icon fa fa-cog"></i>
										Change Password
									</a>
								</li>

								<li>
									<a href="#modal-form" data-toggle="modal" onclick="ajaxModal('<?php echo base_url(MODULE.'/profile/form')?>','','modal-form')">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url('admin/login/logout')?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>				
			</div><!-- /.navbar-container -->
		</div>