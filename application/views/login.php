<!DOCTYPE html>
<html lang="en">
	
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - HRPro System</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?= base_url(); ?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.header {
			    margin-bottom: 0px;
			    margin-top: 0px;
			}
		</style>
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<img src="<?= base_url(); ?>assets/images/<?php echo $setup[0]->Icon ?>" class="" alt="logo" width="30" />
									<span class="white" id="id-text2"><?php echo $setup[0]->AplicationName ?></span>
								</h1>
								<!-- <h4 class="blue" id="id-company-text">&copy; HRSmartPro</h4> -->
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<?php 
						        $this->load->view($main);  
						        ?> 
            				</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
			
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?= base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$.ajaxSetup({
                data: {
                    csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
                }
            });     
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>


</body>
</html>
