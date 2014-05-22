<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Daftar Fungsi Keanggotan MU</h3>
	<span class="pull-right">
	<?php echo form_open('search/mu', 'cari');
	// echo form_open('mu/search', 'cari');
	?>
		<input  class="pull-right label" type=text name=cari>
		<input class="pull-right label" type=submit value="cari">
	<?php echo form_close()?>
		</span>
	<!-- <span class="pull-right label label-important">NOTIF PELANGGAN LAGI
		ONLINE</span> -->
</div>
Konsumen: <br />
<?php echo form_open( current_url() ); ?>
		<?php 
			$user = array(" " => "Semua Kategori");
			$use = $this->db->query(" SELECT DISTINCT
										users.username,
										users.id
										FROM
										(users)
										INNER JOIN users_groups ON users_groups.user_id = users.id
										WHERE `users_groups`.`group_id` IN ('3')
									" )->result();
			foreach ($use as $u)
			{
				$user[$u->id] = ucfirst($u->username);
			}
			 
			echo form_dropdown("user_id", $user, $selected, "onchange='this.form.submit()'") 
		?>
<?php echo form_close() ?>  
<table class="table table-bordered table-striped mediaTable">
	<?php
		/*
		 * Untuk merubah warna sesuai user dalam sistem
		* --------------------------------------------
		* @admin 	: #000000
		* @manajer	: #926737
		*
		*/
		if($this->ion_auth->is_admin())
		{
			echo "<thead><tr style=\"background-color:#202123; color:#FFFFFF;\"><td colspan=\"11\" height=\"16\" style=\"text-align: center\">MASTER FUNGSI KEANGGOTAAN MU</td></tr></thead>";
		}elseif ($this->ion_auth->in_group('manajer')){
			echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"11\" height=\"16\" style=\"text-align: center\">MASTER FUNGSI KEANGGOTAAN MU</td></tr></thead>";
		}else{
			echo "<thead><tr style=\"background-color:#9b262f; color:#FFFFFF;\"><td colspan=\"11\" height=\"16\" style=\"text-align: center\">MASTER FUNGSI KEANGGOTAAN MU</td></tr></thead>";
		}
	?>
	<thead>
		<tr style="color: #000;" align="center">
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Pertanyaan</th>
			<th style="text-align: center;">Nama Konsumen</th>
			<th style="text-align: center;">Dimensi</th>
			<th style="text-align: center;">Nilai Keanggotaan</th>
			<th style="text-align: center;">Nilai Kecewa</th>
			<th style="text-align: center;">Nilai Biasa</th>
			<th style="text-align: center;">Nilai Puas</th>
			<?php
			$x = $this->ion_auth->is_admin();
			echo ($x == TRUE) ? "<th style='text-align: center;' colspan='4'> Aksi</th>" :  "<th style='text-align: center;' colspan='4'></th>" ;
			?>
		</tr>
		
	</thead>
	<?php $no = 0 + $offset;?>
	<?php foreach ($alls as $row) : ?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$no;?></td>
			<td> <?php echo $row->banksoal->pertanyaan; ?></td>
			<td> <?php echo ucfirst($row->users->first_name." ".$row->users->last_name); ?></td>
			<td> <?php echo $row->dimensi->nama; ?></td>
			<td> <?php echo $row->MuFire; ?></td>
			<td> <?php echo $row->MuKecewa; ?></td>
			<td> <?php echo $row->MuBiasa; ?></td>
			<td> <?php echo $row->MuPuas; ?></td>
			<?php
			$x = $this->ion_auth->is_admin();
			$base = site_url();
			echo ($x == TRUE) ? 
				"<td width='70'><a href='$base/mu/update/$row->id' class='btn'><i class='icon-pencil'></i> Edit</a></td>
				 <td width='80'><a href='mu/delete/$row->id' onclick=\"return confirm('Anda yakin hapus data ini?');\" class='btn'><i class='icon-trash'></i> Hapus</a></td> " :  
				"<td> </td>" ;
			?>
		</tr>
	</tbody>
	<?php endforeach; ?>
</table>
<div class="pagination">
	<ul>
		<?php echo $paging;?>
	</ul>
</div>