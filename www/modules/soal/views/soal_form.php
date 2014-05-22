<?php echo $message; ?>
<?php 
	echo form_open('soal/add','class = "form-horizontal well"');
?>
	<fieldset>
		<p class="f_legend">Tambah Data Qustioner</p>
		<div class="control-group">
			<label class="control-label">Pertanyaan</label>
			<div class="controls">
				<textarea name="pertanyaan" cols="1" rows="4" class="span4"></textarea>
			<span class="help-block">*Dengan Kalimat Bahasa Indonesia</span>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label">Faktor: </label>
				<div class="controls">
				<label class="uni-radio">
					<input type="radio" checked="" value="dirasakan" id="uni_r1a" name="faktor" class="uni_style" />
					Di Rasakan
				</label>
				<label class="uni-radio">
					<input type="radio" value="diharapkan" id="uni_r1b" name="faktor" class="uni_style" />
					Di Harapkan
				</label>
				</div>
			</div>
		<div class="control-group">
			<label class="control-label">Dimensi</label>
			<div class="controls">
					<?php  			
						$dimensi = array( '- Pilih -' );
			 			$dim = $this->dimensi_model->get_all();
			 			foreach ($dim as $d)
			 			{
			 				$dimensi[$d->dimensi_id] = $d->nama;
			 			}
			 						
			 			$data['dimensi_id'] = array(
							'name'  => 'dimensi_id',
							'id'    => 'dimensi',
							'type'  => 'text',
							'value' => $dimensi
			 					);
			 			
			 			echo form_dropdown('dimensi', $dimensi, 'dimensi');
						?>					
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Status</label>
			<div class="controls">
				<select name="publish" id="chosen_a" data-placeholder="Ditampilkan..." class="chzn_a">
					<option value="none" selected="selected">- Pilih -</option> 
					<option value="0">Unpublish</option>
                    <option value="1">Publish</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('soal/index');?>" class="btn">Batal</a>
			</div>
			
		</div>
	</fieldset>
<?php echo form_close();?>

