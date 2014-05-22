<?php echo $message; ?>

<?php 
	echo form_open('dimensi/add','class = "form-horizontal well"');
?>
	<fieldset>
		<p class="f_legend">Tambah Data Dimensi</p>
		<div class="control-group">
			<label class="control-label">Nama</label>
			<div class="controls">
				<?php 
					$att = array(
							'name' => 'nama',
							'cols' => '1',
							'rows' => '4',
							'class' => 'span4',
							);
					echo form_textarea($nama,'',$att);?>
			<span class="help-block">*Dengan Kalimat Bahasa Indonesia</span>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label">keterangan: </label>
				<div class="controls">
				<?php
				$att = array(
							'name' => 'keterangan',
							'cols' => '1',
							'rows' => '4',
							'class' => 'span4',
							);
					echo form_textarea($keterangan,'',$att);?>
			<span class="help-block">*Dengan Kalimat Bahasa Indonesia</span>
			</div>
			</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('dimensi/index');?>" class="btn">Batal</a>
			</div>
			
		</div>
	</fieldset>
<?php echo form_close();?>

