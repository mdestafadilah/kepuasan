<?php echo $message;?>
<?php
	echo form_open('user/new_direktur', 'class = "form-horizontal well"');
?>
<fieldset>
		<p class="f_legend">Profile Information</p>
		<div class="control-group">
			<label class="control-label">Nama Depan: </label>
			<div class="controls">
			<?php $u = array(
						'type' => 'text',
						'name' => 'first_name',
						'class'=> 'span4',
						'id' => 'first_name',
					);
			?>
				<?= form_input($u);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan Huruf/ Abjad, Contoh: sarinem</span>
			</div>
		</div>
			<div class="control-group">
			<label class="control-label">Nama Belakang: </label>
			<div class="controls">
			<?php $u = array(
						'type' => 'text',
						'name' => 'last_name',
						'class'=> 'span4',
						'id' => 'last_name',	
					);
			?>
				<?= form_input($u);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan Huruf/ Abjad, Contoh: tukiyem</span>
			</div>
		</div>
			<div class="control-group">
			<label class="control-label">Alamat: </label>
			<div class="controls">
				<textarea name="address" id="txtarea_limit_chars" cols="1" rows="4" class="span4"></textarea>
			</div>
		</div>
			<div class="control-group">
			<label class="control-label">phone: </label>
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
			<label class="control-label">Sex: </label>
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
<p class="f_legend">Login Information</p>
		<div class="control-group">
			<label class="control-label">Username: </label>
			<div class="controls">
			<?php $u = array(
						'type' => 'text',
						'name' => 'username',
						'class'=> 'span4',
						'id' => 'username',	
					);
			?>
				<?= form_input($u);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan Huruf/ Abjad, Contoh: hobaten</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Email: </label>
			<div class="controls">
			<?php
				$e = array(
						'type' => 'text',
						'name' => 'email',
						'class'=> 'span4',
						'id' => 'email',
						
					);
			?>
			<?= form_input($e);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan valid Email, Contoh: admin@gmail.com</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Password: </label>
			<div class="controls">
			<?php
				$p = array(
						'type' => 'password',
						'name' => 'password',
						'class'=> 'span4',
						'id' => 'password',
					);
			?>
			<?= form_input($p);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan kombinasi/angka/huruf, Contoh: 34jk3hyi34</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Konfirmasi Password: </label>
			<div class="controls">
			<?php
				$c = array(
						'type' => 'password',
						'name' => 'password_confirm',
						'class'=> 'span4',
						'id' => 'password_confirm',
					);
			?>
			<?= form_input($c);?>
				<span class="help-block"><span class="f_req">*</span> Isi dengan password yang sama, Contoh: 34jk3hyi34</span>
						</div>
			<br />
	
		</div>
		
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('user');?>" class="btn">Batal</a>
			</div>
</fieldset>
<?php echo form_close(); ?>
