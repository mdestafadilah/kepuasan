<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Daftar Perawat</h3>
	<span class="pull-right">
	<?php //echo form_open('perawat/search', 'cari');
		echo form_open('search/perawat', 'cari');
	?>
		<input  class="pull-right label" type=text name=cari>
			<input class="pull-right label" type=submit value="cari">
	<?php echo form_close()?>
		</span>
	<!-- <span class="pull-right label label-important">NOTIF PERAWAT LAGI ONLINE</span> -->
</div>

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
		echo "<thead><tr style=\"background-color:#202123; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER PERAWAT</td></tr></thead>";
	}elseif ($this->ion_auth->in_group('manajer'))
	{
		echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER PERAWAT</td></tr></thead>";
	}else{
		echo "<thead><tr style=\"background-color:#9b262f; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER PERAWAT</td></tr></thead>";
	}
	?>
	
	<thead>
		<tr style="color: #000;" align="center">
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Nama </th>
			<th style="text-align: center;">Jenis Kelamin</th>
			<th style="text-align: center;">Telephone</th>
			<th style="text-align: center;">Tanggal Lahir</th>
			<th style="text-align: center;">Merawat</th>
			<th style="text-align: center;">Alamat</th>
			<?php
			$url_utama = base_url();
			$x = $this->ion_auth->in_group('manajer') || $this->ion_auth->is_admin();
			$y = $this->ion_auth->in_group('direktur');
			echo  ($x == TRUE) ? "<th style='text-align: center;' colspan='4'><a href=\"$url_utama/perawat/add\" class='btn btn-inverse'><i class='splashy-document_letter_add'></i> Tambah Data</a></th>" : 
				( ($y == TRUE) ? "<th style='text-align: center;' colspan='4'> Aksi </th>" : "None" );

			// echo ($x == TRUE) ? "One" : ( ($y==2) ? "Two" : "None" );
			?>
		</tr>
	</thead>
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
		{
			echo "<thead><tr style=\"background-color:#000000; color:#FFFFFF;\"><td colspan=\"8\" height=\"15\" style=\"text-align: center\">Data Masih Kosong</td></tr></thead>";
		}else{
			echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"8\" height=\"15\" style=\"text-align: center\">Data Masih Kosong</td></tr></thead>";
		}
	
		} else {
			foreach ($hasil as $row) { ?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$i;?></td>
			<td><?php echo ucfirst($row->first_name)?> <?php echo ucfirst($row->last_name);?></td>
			<td><?php echo $row->sex;?></td>
			<td><?php echo $row->phone;?></td>
			<td><?php echo $row->dob;?></td>
			<td><?php echo ucfirst($row->elderly);?></td>
			<td><?php echo $row->address;?></td>
			<?php
			$url_utama = base_url();
			$x = $this->ion_auth->in_group('manajer') || $this->ion_auth->is_admin();
			echo ($x == TRUE) ? 
			"<td width='80'><a href=\"$url_utama/perawat/detail/$row->id\" class='btn'><i class='icon-eye-open'></i> Detail</a></td>
			 <td width='70'><a href=\"$url_utama/perawat/edit/$row->id\" class='btn'><i class='icon-pencil'></i> Edit</a></td>
			 <td width='80'><a href=\"$url_utama/perawat/hapus/$row->id\" onclick=\"return confirm('Anda yakin hapus data ini?');\" class='btn'><i
					class='icon-trash'></i> Hapus</a></td>" : "<td width='80'><a href='perawat/detail/$row->id' class='btn'><i class='icon-eye-open'></i> Detail</a></td>";
			?>
			<!-- 
			<td width="80"><a href="<?= base_url(); ?>perawat/detail/<?= $row->id;?>" class="btn"><i class="icon-eye-open"></i> Detail</a></td>
			<td width="70"><a href="<?= base_url(); ?>perawat/edit/<?= $row->id;?>" class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a href="<?= base_url(); ?>perawat/hapus/<?= $row->id;?>" onclick="return confirm('Anda yakin hapus data ini?');" class="btn"><i
					class="icon-trash"></i> Hapus</a></td>
			-->
		</tr>
	</tbody>
	<?php 
				}
			}
	?>
</table>
<h3 class="heading"></h3>
<div class="pagination">
	<ul>
		<?php echo $paging;?>
	</ul>
</div>
<?php
// dump($this->db->last_query());
// dump($this->db->affected_rows());
?>