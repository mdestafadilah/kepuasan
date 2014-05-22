<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Tambah Level Pengguna</h3>
			<div class="row-fluid">
			<div class="span8">
				<?php echo $message;?>
				<?php echo form_open("group/add",'class="form-vertikal"');?>
				     <fieldset>
				     <div class="control-group formSep">
				      		<label class="control-label">Nama Level: </label>
				             <div class="controls">	
				             <?php echo form_input($name);?>
				           	 <span class="help-block"><span class="f_req">*</span> Isi dengan Huruf dan Unik, Contoh: level, level1</span>
				       	</div>
				      </div>			     
				      	<div class="control-group formSep">
				      		<label class="control-label">Keterangan: </label>
				             <div class="controls">	
				             <?php echo form_textarea($description);?>
				      	</div>
				      </div>
				      <div class="controls">
							<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
							<a href="<?=site_url('group');?>" class="btn">Cancel</a>
						</div>
				</fieldset>
				<?php echo form_close();?>
</div>
</div>
</div>
</div>