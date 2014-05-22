<?php echo $message;?>
<?php 
	echo form_open("auth/change_profile");
?>
<fieldset>
		<p class="f_legend">Edit Pengguna</p>
		<div class="control-group">
			<label class="control-label">Level: </label>
		
		<div class="control-group">
			<label class="control-label">Username: </label>
			<div class="controls">
				<?= form_input($username);?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Email: </label>
			<div class="controls">
			<?= form_input($email);?>
			</div>
		</div>
	  		<?php echo form_hidden($user_id); ?>
		<br />
		<div class="controls">
			<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
			<a href="<?=site_url('user');?>" class="btn">Cancel</a>
		</div>
			
</fieldset>
<?php echo form_close(); ?>
