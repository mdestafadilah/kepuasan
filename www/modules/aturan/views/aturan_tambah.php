<?php echo $message; ?>

<?php 
	echo form_open('aturan/add','class = "form-horizontal well"');
?>
	<fieldset>
		<p class="f_legend">Tambah Data Aturan</p>
		<div class="control-group">
			<label class="control-label">Variabel</label>
			<div class="controls">
				<?php echo form_input($variabel);?>
			<span class="help-block">*Dengan Kalimat Bahasa Indonesia</span>
			</div>
		</div>
		
		<div class="control-group">
				<label class="control-label">Batas Atas: </label>
				<div class="controls">
				<?php 
				$pilihan = array(
						'100'  	=> 100,
						'80'    => 80,
						'65'   	=> 65,
						'40' 	=> 40,
						'0'		=> 0
				);
				
				$max = array('40', '65');
				
				echo form_dropdown('nilai', $pilihan, '65');
				
				?>
					<span class="help-block">*Harus beda dari data yang ada!!</span>
				</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('aturan/index');?>" class="btn">Cancel</a>
			</div>
			
		</div>
	</fieldset>
<?php echo form_close();?>

