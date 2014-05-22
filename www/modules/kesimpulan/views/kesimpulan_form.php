<?php echo $message; ?>
<?php 
	echo form_open('kesimpulan/add','class = "form-horizontal well"');
?>
	<fieldset>
		<p class="f_legend">Tambah Data Kesimpulan</p>
		<div class="control-group">
			<label class="control-label">Kesimpulan</label>
			<div class="controls">
				<?= form_textarea($kesimpulan);?>
			<span class="help-block">*Pisahkan dengan koma (,)</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Dimensi</label>
				<div class="controls">
			<?php
				$dimensi = $this->dimensi_model->as_array()->get_all();
			
				foreach ($dimensi as $ar)
					{
						echo " <br /> ". form_checkbox('dimensi[]', $ar['nama'] ) . ucfirst($ar['nama']);	
					}
			?>
			</div>			
		</div>
		<div class="control-group">
			<div class="controls">
			    <?php //form_hidden('kesimpulan_id', $single->kesimpulan_id);?>	
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('kesimpulan/index');?>" class="btn">Batal</a>
			</div>
			
		</div>
	</fieldset>
<?php echo form_close();?>

