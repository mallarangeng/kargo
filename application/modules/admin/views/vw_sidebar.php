<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
				<ul class="nav nav-list">
					<li class="hover" id="main0">
						<a href="<?php echo base_url(MODULE)?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?php 									
						$sql1 = $this->m_admin->get_sidebar(array('A.id_level'=>0));		
						$no=1;									
						foreach ($sql1 as $row){
							echo '<li class="hover" id="main'.$no.'">
									<a href="'.base_url().'" class="dropdown-toggle">
										<i class="menu-icon '.$row['icon'].'"></i>
										<span class="menu-text">
											'.$row['name'].'
										</span>			
										<b class="arrow fa fa-angle-down"></b>
									</a>
								<b class="arrow"></b>
								<ul class="submenu">';
								$sql2 = $this->m_admin->get_sidebar(array(
															'A.id_modul_parent'=>$row['id_modul'],
															'A.id_level'=>1
												));
								foreach ($sql2 as $val){
									echo '<li class="main'.$no.' hover">
											<a href="'.base_url($val['url_route']).'">
												<i class="menu-icon fa fa-caret-right"></i>
												'.$val['name'].'
											</a>
											<b class="arrow"></b>
										</li>';
								}							
							echo '</ul>';
						echo '</li>';
						$no++;
						}
					?>											
				</ul><!-- /.nav-list -->
			</div>