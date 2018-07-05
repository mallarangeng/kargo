<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - <?php echo $this->config->config['title1'].' '.$this->config->config['title2']?></title>
		<link rel="shorcut icon" href="<?php echo base_url()?>assets/images/logo/gapura-icon.ico">
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />		
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />		
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/fonts.googleapis.com.css" />		
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.min.css" />		
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-rtl.min.css" />		
	</head>

	<body class="login-layout" style="background-color:#ffffff">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">	
								<h1>							
									<img src="<?php echo base_url('assets/images/logo/'.$this->session->userdata('logo_company'))?>" style="width: 200px"><br>
															
											<span class="red"><?php echo $this->config->config['title1']?></span>
											<span class="black"><?php echo $this->config->config['title2']?></span>									
										
								</h1>							
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">										
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>											
											<div class="danger" style='display:none'><?php echo validation_errors(); ?></div>
											<div class="success" style="display:none"><?php echo $this->session->flashdata('success')?></div>
											<div class="space-6"></div>
											<?php echo form_open(base_url('admin/login'))?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="email" class="form-control" value="<?php echo set_value('email')?>" placeholder="Email" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password')?>"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													
													<div class="space"></div>
													<div class="clearfix">													
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											<?php echo form_close()?>
											<div class="social-or-login center">
													<span class="bigger-110">&copy; <?php echo $_SESSION['company_name']?></span>
												</div>	
										</div><!-- /.widget-main -->										
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->								
							</div><!-- /.position-relative -->													
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->		
		<script src="<?php echo base_url()?>assets/js/jquery-2.1.4.min.js"></script>	
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>		
		<script type="text/javascript">
		$(document).ready(function() {
			
			//autoload notif alert option
			 var x = $('.success').html();	
			 var y = $('.warning').html();
			 var z = $('.danger').html();
		     if(x !=''){      	
		    	 show_alert('.success','success',x);
		     }
		     if(y !=''){ 
		     	
		    	 show_alert('.warning','warning',y);
		     }
		     if(z !=''){       	
		    	 show_alert('.danger','danger',z);
		     }
	      });
			function show_alert(div,status,msg){	
				$(div).removeClass("alert alert-block alert-danger");
				$(div).removeClass("alert alert-block alert-success");
				$(div).removeClass("alert alert-block alert-warning");
				$(div).addClass("alert alert-block alert-"+status);
				if(status == 'warning')
					var span = ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="label label-warning">WARNING!</strong><br>';
				else if (status == 'success')
					var span = ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="label label-success">CONGRATULATIONS!</strong><br>';
				else if (status == 'danger')
					var span = ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="label label-important">ERROR!</strong><br>';
			    //$(div).html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+"<b>"+msg+"</b>").show(500);
			    $(div).html(span+msg).slideDown();//slideDown(500);
	//		 	$(div).removeClass('hide');
			    //$(div).slideUp();
				setTimeout(function(){ $(div).slideUp(500); },10000);
			}
		</script>
		
	</body>
</html>
