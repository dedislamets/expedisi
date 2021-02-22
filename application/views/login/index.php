<!-- Authentication card start -->
<?php if(isset($error)) { echo $error; }; ?>
<form method="POST" action="<?php echo base_url() ?>index.php/login" class="md-float-material form-material">                   
    <div class="text-center">
        <img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" alt="logo.png">
    </div>
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center">Sign In</h3>
                </div>
            </div>
            <div class="form-group form-primary">
                <input type="text" name="username" class="form-control" required="" placeholder="Your Email Address">
                <span class="form-bar"><?php echo form_error('username'); ?></span>

            </div>
            <div class="form-group form-primary">
                <input type="password" name="password" class="form-control" required="" placeholder="Password">
                <span class="form-bar"> <?php echo form_error('password'); ?></span>
            </div>
            <div class="row m-t-25 text-left">
                <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                        <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">Remember me</span>
                        </label>
                    </div>
                    <div class="forgot-phone text-right f-right">
                        <a href="<?php echo base_url() ?>login/forgot" class="text-right f-w-600"> Forgot Password?</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                    <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
                </div>
            </div>
            <hr>
            
        </div>
    </div>
</form>
<!-- end of form -->

				