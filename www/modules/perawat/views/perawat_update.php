
<?php echo $message;?>

<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Edit Data Perawat</h3>
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_l1" data-toggle="tab">Personal
						Information</a>
				</li>
				<li><a href="#tab_l3" data-toggle="tab">Avatar Information</a></li>

			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_l1">
					<p>
						<?php 
						echo form_open("user/perawat/ubah_profile/");
						?>
					
					<fieldset>

						<div class="control-group">
							<label class="control-label">Nama Depan: </label>
							<div class="controls">
								<?= form_input($first_name);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Nama Belakang: </label>
							<div class="controls">
								<?= form_input($last_name);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Alamat: </label>
							<div class="controls">
								<?= form_input($address);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Telephone: </label>
							<div class="controls">
								<?= form_input($phone);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal Lahir: </label>
							<div class="controls">
								<?= form_input($dob);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Sex: </label>
							<div class="controls">
								<label class="uni-radio"> <input type="radio" checked=""
									value="L" id="uni_r1a" name="sex" class="uni_style" />
									Laki-laki </label> <label class="uni-radio"> <input
									type="radio" value="P" id="uni_r1b" name="sex"
									class="uni_style" /> Perempuan </label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Email: </label>
							<div class="controls">
								<?= form_input($email);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Username: </label>
							<div class="controls">
								<?= form_input($username);?>
							</div>
						</div>
						<?php echo form_hidden($user_id); ?>
						<br />
						<div class="controls">
							<button type="submit" class="btn btn-inverse" id="sticky_b">
								<i class="splashy-check"></i> Simpan
							</button>
							| <a href="<?=site_url('perawat');?>" class="btn">Cancel</a>
						</div>

					</fieldset>
					<?php echo form_close();?>

				</div>
				<d iv class="tab-pane" id="tab_l3">
				<p>Will be soon</p>
			</div>
		</div>
	</div>
</div>
</div>
