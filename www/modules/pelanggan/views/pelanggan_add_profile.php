<?php echo $message; ?>
<?php echo form_open_multipart('pelanggan/add_profile','class = "form-horizontal well"')?>
<fieldset>
	<p class="f_legend">Tambah Profile Data </p>
	<div class="control-group">
		<label class="control-label">Foto</label>
		<div class="span4">
			<input type="file" name="foto" id="uni_file" class="uni_style" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Nama Login</label>
		<div class="span4">
			<?php
				$users = array();
		 		// $user = $this->user_model->get_all();
		 		$user = $this->ion_auth->users('3')->result();
		 		foreach ($user as $u)
		 		{
		 			$users[$u->id] = $u->username;
		 		}
		 		
		 		$data['user_id'] = array(
		 				'name'  => 'user_id',
		 				'id'    => 'user',
		 				'type'  => 'text',
		 				'value' => $users,
		 		);
		 		 
 		echo form_dropdown('users', $users, 'user');
 		?>
		</div>
	</div>
	        <div class="formSep">
                       
                    </div>           
	<div class="control-group">
	 <div class="formSep">
	
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('perawat/index');?>" class="btn">Cancel</a>
			</div>
			</div>
		</div>
</fieldset>
<?php echo form_close();?>