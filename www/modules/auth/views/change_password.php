<?php echo $message;?>

<?php echo form_open("auth/change_password");?>

<p>
	Password Lama:<br />
	<?php echo form_input($old_password);?>
</p>

<p>
	Password Baru ( minimal panjang
	<?php echo $min_password_length;?>
	karakter ):<br />
	<?php echo form_input($new_password);?>
</p>

<p>
	Konfirmasi Password Baru:<br />
	<?php echo form_input($new_password_confirm);?>
</p>

	<?php echo form_hidden($user_id);?>

<div class="controls">
	<button type="submit" class="btn btn-inverse" id="sticky_b">
		<i class="splashy-check"></i> Simpan
	</button>
	| <a href="<?=site_url('home');?>" class="btn">Batal</a>
</div>
	<?php echo form_close();?>
