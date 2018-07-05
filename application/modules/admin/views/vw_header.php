<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $page_title?> - <?php echo $this->config->config['title1'].' '.$this->config->config['title2']?></title>
		<meta name="description" content="<?php echo $page_title?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />	
		<meta name="<?php echo csrf_token()['name']?>" content="<?php echo csrf_token()['hash']?>">	
		<link rel="shorcut icon" href="<?php echo base_url()?>assets/images/logo/gapura-icon.ico">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/chosen.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/colorbox.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-multiselect.min.css" />
		
		<link rel='stylesheet' type='text/css' href='<?php echo base_url()?>assets/datatables/css/jquery.dataTables.min.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo base_url()?>assets/datatables/css/responsive.dataTables.min.css'>			
		<script src="<?php echo base_url()?>assets/js/ace-extra.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery-2.1.4.min.js"></script>		
	</head>
	<body class="skin-1">
		<div id="loading"></div>
		<?php $this->load->view('vw_navbar')?>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<?php $this->load->view('vw_sidebar')?>
			<?php $this->load->view($body)?>			
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->	
		<div id="modal-form" class="modal" tabindex="-1"></div>	
		<?php $this->load->view('vw_footer')?>
		<input type="hidden" id="url_sess" value="<?php echo $this->session->userdata('url_sess')?>">		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/datatables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/datatables/js/dataTables.responsive.min.js"></script>		
		<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>		
		<script src="<?php echo base_url()?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/ace.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/function.js"></script>	
		<script src="<?php echo base_url()?>assets/js/fungsi.js"></script>
		
		<script src="<?php echo base_url()?>assets/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.min.js"></script>	
		
	
		<script src="<?php echo base_url()?>assets/js/dataTables.buttons.min.js"></script>
		<!-- <script src="<?php //echo base_url()?>assets/js/buttons.flash.min.js"></script>-->
		<script src="<?php echo base_url()?>assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url()?>assets/tinymce/tinymce.min.js"></script>	
		<script src="<?php echo base_url()?>assets/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.colorbox.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/bootstrap-multiselect.min.js"></script>
		<script type="text/javascript">
			jQuery(function($) {							
			 var $sidebar = $('.sidebar').eq(0);
			 if( !$sidebar.hasClass('h-sidebar') ) return;			
			 $(document).on('settings.ace.top_menu' , function(ev, event_name, fixed) {
				if( event_name !== 'sidebar_fixed' ) return;
			
				var sidebar = $sidebar.get(0);
				var $window = $(window);
			
				//return if sidebar is not fixed or in mobile view mode
				var sidebar_vars = $sidebar.ace_sidebar('vars');
				if( !fixed || ( sidebar_vars['mobile_view'] || sidebar_vars['collapsible'] ) ) {
					$sidebar.removeClass('lower-highlight');
					//restore original, default marginTop
					sidebar.style.marginTop = '';
			
					$window.off('scroll.ace.top_menu')
					return;
				}
			
			
				 var done = false;
				 $window.on('scroll.ace.top_menu', function(e) {
			
					var scroll = $window.scrollTop();
					scroll = parseInt(scroll / 4);//move the menu up 1px for every 4px of document scrolling
					if (scroll > 17) scroll = 17;			
			
					if (scroll > 16) {			
						if(!done) {
							$sidebar.addClass('lower-highlight');
							done = true;
						}
					}
					else {
						if(done) {
							$sidebar.removeClass('lower-highlight');
							done = false;
						}
					}
			
					sidebar.style['marginTop'] = (17-scroll)+'px';
				 }).triggerHandler('scroll.ace.top_menu');
			
			 }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
			
			 $(window).on('resize.ace.top_menu', function() {
				$(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
			 });		
			
			});
		</script>
	</body>
</html>
