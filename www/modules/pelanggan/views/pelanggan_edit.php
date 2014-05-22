
<?php echo $message;?>

<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Edit Data Perawat</h3>
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_l1" data-toggle="tab">Personal Information</a></li>
				<li><a href="#tab_l3" data-toggle="tab">Avatar Information</a></li>

			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_l1">
					<p>
						<?php 
						echo form_open('pelanggan/edit/'.$single->id);
						?>
					
					
					<fieldset>
			
						<div class="control-group">
							<label class="control-label">Nama Depan: </label>
							<div class="controls">
								<?php $u = array(
										'type' => 'text',
										'name' => 'first_name',
										'class'=> 'span4',
										'id' => 'first_name',
										'value' => $single->first_name,
								);
								?>
								<?= form_input($u);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Nama Belakang: </label>
							<div class="controls">
								<?php
								$e = array(
										'type' => 'text',
										'name' => 'last_name',
										'class'=> 'span4',
										'id' => 'last_name',
										'value' => $single->last_name,
								);
								?>
								<?= form_input($e);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Alamat: </label>
							<div class="controls">
								<?php
								$e = array(
										'type' => 'text',
										'name' => 'address',
										'class'=> 'span4',
										'id' => 'address',
										'value' => $single->address,
								);
								?>
								<?= form_input($e);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Telephone: </label>
							<div class="controls">
								<?php
								$e = array(
										'type' => 'text',
										'name' => 'phone',
										'class'=> 'span4',
										'id' => 'phone',
										'value' => $single->phone,
								);
								?>
								<?= form_input($e);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal Lahir: </label>
							<div class="controls">
								<?php
								$e = array(
										'type' => 'text',
										'name' => 'dob',
										'class'=> 'input-medium',
										'id' => 'dp1',
										'value' => $single->dob,
								);
								?>
								<?= form_input($e);?>
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
							<label class="control-label">Jenis Rawat</label>
							<div class="controls">
								<select name="elderly" id="chosen_a"
									data-placeholder="Pilih jenis rawat..." class="chzn_a">
									<option value="<?php echo $single->elderly;?>"
										selected="selected">- Pilih -</option>
									<option value="balita">Anak Balita</option>
									<option value="ortu">Orangtua</option>
									<option value="adk">Khusus</option>
								</select>
							</div>
						</div>
							<div class="control-group">
							<label class="control-label">Username: </label>
							<div class="controls">
								<?php $u = array(
										'type' => 'text',
										'name' => 'first_name',
										'class'=> 'span4',
										'id' => 'first_name',
										'value' => $single->username,
								);
								?>
								<?= form_input($u);?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Password: </label>
							<div class="controls">
								<?php $u = array(
										'type' => 'text',
										'name' => 'new_password',
										'class'=> 'span4',
										'id' => 'new_password',
										'value' => $single->password,
										
								);
								?>
								<?= form_password($u);?>
							</div>
						</div>
						<?php echo form_hidden(array('id'=>$single->id)); ?>
						<br />
						<div class="controls">
							<button type="submit" class="btn btn-inverse" id="sticky_b">
								<i class="splashy-check"></i> Simpan
							</button>
							| <a href="<?=site_url('pelanggan');?>" class="btn">Cancel</a>
						</div>

					</fieldset>
					<?php echo form_close();?>
				</div>
				<d	iv class="tab-pane" id="tab_l3">
					<p>
						Still <em>Development!!</em>
					</p>
				</div>
			</div>
		</div>
	</div>
	</div>