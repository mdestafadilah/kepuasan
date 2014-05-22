<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Tambah Pengguna Sistem</h3>
			<div class="row-fluid">
			<div class="span8">
				<?php echo $message;?>
				<?php echo form_open("auth/create_user",'class="form-vertikal"');?>
				     <fieldset>
				     <div class="control-group formSep">
				      		<label class="control-label">Username: </label>
				             <div class="controls">	
				             <?php echo form_input($username);?>
				      	</div>
				      </div>			     
				      	<div class="control-group formSep">
				      		<label class="control-label">Email: </label>
				             <div class="controls">	
				             <?php echo form_input($email);?>
				      	</div>
				      </div>
				   
				      <div class="control-group formSep">
				      		<label class="control-label">Password: </label>
				            <div class="controls">	
				      		<?php echo form_input($password);?>
				      </div>
				      </div>
				      <div class="control-group formSep">
				      		<label class="control-label">Confirm Password: </label>
				            <div class="controls">
				            <?php echo form_input($password_confirm);?>
				     </div>
				     </div>
				      <p><?php echo form_submit('submit', 'Create User');?></p>
				      <p><?php echo anchor('user/index','Cancel')?></p>
				</fieldset>
				<?php echo form_close();?>
</div>
</div>
</div>
</div>