<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Dashboard Member Panel - Login Page</title>

<!-- Bootstrap framework -->
<?=css('bootstrap.min.css')?>
<?=css('bootstrap-responsive.min.css') ?>
<!-- theme color-->
<?=css('blue.css')?>
<!-- tooltip -->
<?=css('jquery.qtip.min.css')?>
<!-- main styles -->
<?=css('style.css')?>
<!-- Favicons and the like (avoid using transparent .png) -->
<link rel="shortcut icon" href="favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="icon.png" />

<link rel="stylesheet" href="<?=asset_url()?>img/splashy/splashy.css" />

<link href='http://fonts.googleapis.com/css?family=PT+Sans'
	rel='stylesheet' type='text/css'>

<!--[if lte IE 8]>
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->

</head>

<body class="login_page" id="bek">

	<div class="login_box">
		<?php 
		$attr = array(
				'id' => "login_form",
		);
		?>
		<?php echo form_open("auth/login",$attr);?>
		<div class="top_b">Login - Sistem Informasi Kepuasan</div>
		
				
		<?php echo $message;?>

		<div class="cnt_b">

			<div class="formRow">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i> </span>
					<?php 
					$identity = array(
							'type' => "text",
							'id' => "username",
							'name' => "identity",
							'placeholder' => "Identity/Email",
					);
					?>
					<?php echo form_input($identity);?>
				</div>
			</div>

			<div class="formRow">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i> </span>
					<?php 
					$password = array(
							'type' => "password",
							'id'   => "password",
							'name' => "password",
							'placeholder' => "Password",
					);
					?>
					<?php echo form_input($password);?>
				</div>
			</div>

			<div class="formRow clearfix">
				<label class="checkbox" for="remember"> <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>Remember</label>
			</div>
		</div>
		<div class="btm_b clearfix">
			<span class="link_reg"> 
				<button class="btn" data-loading-text="Loading..." id="fat-btn">Login</button> 			
			</span>
		</div>
		<?php echo form_close();?>

		<!-- MODUL LUPA PASSWORD -->
		<?php //------------------------------------------------------------------------------- ?>
		<?php 
		$lupa = array(
				'id' => "pass_form",
				'style' => "display:none",
		);
		?>
		<?php echo form_open("auth/forgot_password",$lupa);?>
		<div class="top_b">Can't sign in?</div>
		<div class="alert alert-info alert-login" id="infoMessage">
			<?php echo $message;?>
		</div>
		<div class="cnt_b">
			<div class="formRow clearfix">
				<div class="input-prepend">
					<span class="add-on">@</span>
					<?php 
					$email = array(
							'type' => "text",
							'placeholder' => "Tuliskan Alamat Email Valid",
					);
					?>
					<?php echo form_input($email);?>
				</div>
			</div>
		</div>
		<div class="btm_b tac">
			<?php echo form_submit('submit', 'Submit', 'class="btn btn-inverse"');?>
		</div>
		<?php echo form_close();?>
		<?php //------------------------------------------------------------------------------- ?>

	</div>
	<!-- Footer copirigh -->
	<div class="links_b links_btm clearfix">
		<span class="linkform">Copyright &copy; 2013 - Present by: D3ZT4 for
			PT. Narendra Krida</span>
	</div>

	<!-- Assets -->
	<?= js('jquery.min.js') ?>
	<?= js('jquery.actual.min.js')?>
	<?= js('bootstrap.min.js')?>
	<?= js('jquery.validate.min.js')?>
	<script>
            $(document).ready(function(){
                
				//* boxes animation
				form_wrapper = $('.login_box');
                $('.linkform a,.link_reg a').on('click',function(e){
					var target	= $(this).attr('href'),
						target_height = $(target).actual('height');
					$(form_wrapper).css({
						'height'		: form_wrapper.height()
					});	
					$(form_wrapper.find('form:visible')).fadeOut(400,function(){
						form_wrapper.stop().animate({
                            height	: target_height
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
							$(form_wrapper).css({
								'height'		: ''
							});	
                        });
					});
					e.preventDefault();
				});
				
				//* validation
				$('#login_form').validate({
					onkeyup: false,
					errorClass: 'error',
					validClass: 'valid',
					rules: {
						identity: { required: true, minlength: 5 },
						password: { required: true, minlength: 3 }
					},
					highlight: function(element) {
						$(element).closest('div').addClass("f_error");
					},
					unhighlight: function(element) {
						$(element).closest('div').removeClass("f_error");
					},
					errorPlacement: function(error, element) {
						$(element).closest('div').append(error);
					}
				});
            });
        </script>
			<!-- buttons functions -->
			<?= js('gebo_btns.js')?>
			<!-- custom validation -->
			<?= js('gebo_validations.js')?>		
</body>
</html>
