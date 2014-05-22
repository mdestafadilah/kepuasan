<?php echo $message; ?>
<?php 
	echo form_open_multipart('perawat/add','class = "form-horizontal well"');
?>
	<fieldset>
		<p class="f_legend">Tambah Data Perawat</p>
		<div class="control-group">
			<label class="control-label">Nama Depan</label>
			<div class="controls">
				<input type="text" id="first_name" name="first_name" class="span6" value="<?=set_value('first_name');?>" />
				<span class="help-block"><span class="f_req">*</span> Isi dengan Huruf/ Abjad, Contoh: sarinem</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Belakang</label>
			<div class="controls">
				<input type="text" name="last_name" class="span6" value="<?=set_value('last_name');?>"/>
				<span class="help-block"><span class="f_req">*</span> Isi dengan Huruf/ Abjad, Contoh: sarinem</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Lahir: </label>
			<div class="controls">
			<?php $u = array(
						'type' => 'text',
						'name' => 'dob',
						'class'=> 'input-medium',
						'id' => 'dp1',	
					);
			?>
				<?= form_input($u);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan Tahun-Bulan-Tanggal, Contoh: 2012-30-12</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Telepone: </label>
			<div class="controls">
			<?php $u = array(
						'type' => 'text',
						'name' => 'phone',
						'class'=> 'input-medium',
						'id' => 'phone',	
					);
			?>
				<?= form_input($u);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan Angka, Contoh: 083898973731</span>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label">Jenis Kelamin: </label>
				<div class="controls">
				<label class="uni-radio">
					<input type="radio" checked="" value="L" id="uni_r1a" name="sex" class="uni_style" />
					Laki-laki
				</label>
				<label class="uni-radio">
					<input type="radio" value="P" id="uni_r1b" name="sex" class="uni_style" />
					Perempuan
				</label>
				</div>
			</div>
		<div>
			<label class="control-label">Alamat: </label>
			<div class="controls">
				<textarea name="address" id="txtarea_limit_chars" cols="1" rows="4" class="span4"></textarea>
			</div>
		</div><br />
		<div class="control-group">
			<label class="control-label">Jenis Rawat</label>
			<div class="controls">
				<select name="elderly" id="chosen_a" data-placeholder="Pilih jenis rawat..." class="chzn_a">
					<option value="none" selected="selected">- Pilih -</option> 
					<option value="balita">Anak Balita</option>
                    <option value="ortu">Orangtua</option>
                    <option value="adk">Khusus</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('perawat');?>" class="btn">Batal</a>
			</div>
		</div>
	</fieldset>
<?php echo form_close();?>

