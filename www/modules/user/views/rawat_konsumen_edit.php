<?php echo $message; ?>
<?php 
echo form_open(uri_string(),'class = "form-horizontal well"');
//echo form_open('user/manajer/edit_informasi/','class = "form-horizontal well"')?>
<fieldset>
	<p class="f_legend">Update Info Perawat Konsumen</p>
	<div class="control-group">
		<label class="control-label">Nama Konsumen</label>
		<div class="span4">
			<?php
				/* $konsumen_id = array();
		 		// $user = $this->user_model->get_all();
		 		$user = $this->ion_auth->users('3')->result();
		 		foreach ($user as $u)
		 		{
		 			$konsumen_id[$u->id] = $u->username;
		 		}
		 		
		 		$data['konsumen_id'] = array(
		 				'name'  => 'konsumen_id',
		 				'id'    => 'konsumen_id',
		 				'type'  => 'text',
		 				'value' => $konsumen_id,
		 		); */
			
			$konsumen_id = array();
		 	$konsumen = $this->ion_auth->users('3')->result();
			foreach ($konsumen as $ko)
			{
				$konsumen_id[$ko->id] = $ko->username;
			}
		 		 
 		echo form_dropdown('konsumen_id', $konsumen_id, 'konsumen_id');
 		?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Nama Pelanggan</label>
		<div class="span4">
			<?php
				/* $perawat_id = array();
		 		// $user = $this->user_model->get_all();
		 		$user = $this->ion_auth->users('4')->result();
		 		foreach ($user as $u)
		 		{
		 			$perawat_id[$u->id] = $u->username;
		 		}
		 		
		 		$data['perawat_id'] = array(
		 				'name'  => 'perawat_id',
		 				'id'    => 'perawat_id',
		 				'type'  => 'text',
		 				'value' => $perawat_id,
		 		); */
			
			$perawat_id = array();
		 	$perawat = $this->ion_auth->users('4')->result();
				foreach ($perawat as $ko)
			{
				$perawat_id[$ko->id] = $ko->username;
			}
		 		 
 		echo form_dropdown('perawat_id', $perawat_id, 'perawat_id');
 		?>
		</div>
	</div>
	        <div class="formSep">
                       
                    </div>           
	<div class="control-group">
	 <div class="formSep">
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('user/manajer/list_rawat_konsumen/index');?>" class="btn">Cancel</a>
			</div>
			</div>
		</div>
</fieldset>
<?php echo form_close();?>