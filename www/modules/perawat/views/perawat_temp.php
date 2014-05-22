<?php
							$perawat_id = 1;
							$rawat = $this->perawat->get($perawat_id);
						?>
						<li>
							<span class="item-key">Nama Depan</span>
								<div class="vcard-item">
									<?php echo $rawat->first_name;?>
									<hr />
								</div>
							<span class="item-key">Nama Belakang</span>
								<div class="vcard-item">
									<?php echo $rawat->last_name;?>
									<hr />
								</div>
							<span class="item-key">Jenis Kelamin</span>
								<div class="vcard-item">
									<?php echo $rawat->jenkel;?>
									<hr />
								</div>
							<span class="item-key">Tanggal Lahir</span>
								<div class="vcard-item">
									<?php echo $rawat->dob;?>
									<hr />
								</div>
							<span class="item-key">Ijasah</span>
								<div class="vcard-item">
									<?php echo $rawat->ijasah;?>
									<hr />
								</div>
							<span class="item-key">Alamat</span>
								<div class="vcard-item">
									<?php echo $rawat->alamat;?>
									<hr />
								</div>
							<span class="item-key">ID User</span>
								<div class="vcard-item">
									<?php echo '12';?>
									<hr />
								</div>
						</li>
						
						<?php $i = 0 + $offset;?>
	
	<?php if(!$hasil) {
		/*
		 * Untuk merubah warna jika data kososng sesuai user
		* --------------------------------------------
		* @admin 	: #000000
		* @manajer	: #926737
		*
		*/
		if($this->ion_auth->is_admin())
		{ echo "<thead><tr style=\"background-color:#000000; color:#FFFFFF;\"><td colspan=\"8\" height=\"15\" style=\"text-align: center\">Data Masih Kosong</td></tr></thead>"; }
	else{ echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"8\" height=\"15\" style=\"text-align: center\">Data Masih Kosong</td></tr></thead>"; }
		} else {
			foreach ($hasil as $row) { ?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$i;?></td>
			<td><?php echo $row->first_name, $row->last_name;?></td>
			<td><?php echo $row->foto;?></td>
			<td><?php echo $row->dob;?></td>
			<td><?php echo $row->jenkel;?></td>
			<td><?php echo $row->alamat;?></td>
			<td width="80"><a href="<?php echo base_url(); ?>perawat/detail/<?php echo $row->perawat_id;?>" class="btn"><i class="icon-eye-open"></i> Detail</a></td>
			<td width="70"><a href="<?php echo base_url(); ?>perawat/edit/<?php echo $row->perawat_id;?>" class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a href="<?php echo base_url(); ?>perawat/hapus/<?php echo $row->perawat_id;?>" onclick="return confirm('Anda yakin hapus data ini?');" class="btn"><i
					class="icon-trash"></i> Hapus</a></td>
		</tr>
	</tbody>
	<?php 
				}
			}
	?>