<?php echo $message; ?>
<?php 
	echo form_open(current_url(),'class = "form-horizontal well"');
?>
	<fieldset>
		<p class="f_legend">Ubah Fungsi Keanggotaan</p>
		<div class="control-group">
			<label class="control-label">Total Nilai</label>
			<div class="controls">
				<?= form_input($MuHasil); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Nilai Kecewa</label>
			<div class="controls">
				<?= form_input($MuKecewa);?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Nilai Biasa</label>
			<div class="controls">
				<?= form_input($MuBiasa); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Nilai Puas</label>
			<div class="controls">
				<?= form_input($MuPuas); ?>
			</div>
		</div>
		<div class="control-group">
				<label class="control-label">Konsumen: </label>
				<div class="controls">
					<?php
					$users = array( '- Pilih -');
					$user = $this->db->query("
											SELECT DISTINCT
											*
											FROM
											users
											INNER JOIN users_groups ON users_groups.user_id = users.id
											WHERE `users_groups`.`group_id` IN ('3')")->result();
					foreach ($user as $u)
					{
						$users[$u->id] = ucfirst($u->username);
					}
					
					echo form_dropdown('user_id', $users, 'user_id');

					?>
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
			 				$dimensi[$d->dimensi_id] = ucfirst($d->nama);
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
			<label class="control-label">Soal</label>
			<div class="controls">
				<?php
					$banksoal = array( '- Pilih -');
					$soal = $this->db->query("
											SELECT
											*
											FROM
											banksoal
											GROUP BY
											banksoal.pertanyaan
											")->result();
					
					foreach ($soal as $s)
					{
						$banksoal[$s->banksoal_id] = ucfirst($s->pertanyaan)." | ".ucfirst($s->faktor);
					}
					echo form_dropdown('banksoal', $banksoal, 'banksoal');
					?>
			</div>
		</div>
			<?php echo form_hidden(array('id', $single->id)); ?>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-inverse" id="sticky_b"><i class="splashy-check"></i> Simpan </button> | 
				<a href="<?=site_url('soal/index');?>" class="btn">Batal</a>
			</div>
			
		</div>
	</fieldset>
<?php echo form_close();?>

