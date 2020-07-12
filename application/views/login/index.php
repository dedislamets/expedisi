<div id="login-box" class="login-box visible widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header blue lighter bigger">
				<i class="ace-icon fa fa-coffee green"></i>
				Please Enter Your Information
			</h4>

			<div class="space-6"></div>
			<?php if(isset($error)) { echo $error; }; ?>
			<form method="POST" action="<?php echo base_url() ?>index.php/login">
				<fieldset>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="text" name="username" class="form-control" placeholder="Username Or EmployeeId" />
							<i class="ace-icon fa fa-user"></i>
						</span>
						<?php echo form_error('username'); ?>
					</label>

					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="password" name="password" class="form-control" placeholder="Password" />
							<i class="ace-icon fa fa-lock"></i>
						</span>
						 <?php echo form_error('password'); ?>
					</label>

					<div class="space"></div>

					<div class="clearfix">
						<a href="<?php echo base_url() ?>login/forgot" style="text-decoration: underline;">Forgot Password</a>
						<!-- <label class="inline">
							<input type="checkbox" class="ace" />
							<span class="lbl"> Remember Me</span>
						</label> -->

						<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
							<i class="ace-icon fa fa-key"></i>
							<span class="bigger-110">Login</span>
						</button>
					</div>
					<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
					<div class="space-4"></div>
				</fieldset>
			</form>

			
		</div><!-- /.widget-main -->

		<!-- <div class="toolbar clearfix">
			<div>
				<a href="#" data-target="#forgot-box" class="forgot-password-link">
					<i class="ace-icon fa fa-arrow-left"></i>
					I forgot my password
				</a>
			</div>
		</div> -->
	</div><!-- /.widget-body -->
</div>
				