<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Info Pasangan</h3>
	<span class="pull-right">
	<?php echo form_open('#', 'cari');?>
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
		echo "<thead><tr style=\"background-color:#202123; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER PASANGAN</td></tr></thead>";
	}elseif ($this->ion_auth->in_group('manajer')){
		echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER PASANGAN</td></tr></thead>";
	}else{
		echo "<thead><tr style=\"background-color:#9b262f; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER PASANGAN</td></tr></thead>";
	}
	?>
	
	<thead>
		<tr style="color: #000;" align="center">
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Nama Konsumen </th>
			<th style="text-align: center;">Nama Perawat </th>
			<th style="text-align: center;">Jenis Rawat</th>
			<th style="text-align: center;">Alamat Konsumen</th>
			<th style="text-align: center;" colspan="4"><a
				href="<?php echo base_url(); ?>user/manajer/rawat_konsumen" class="btn btn-inverse"><i
					class="splashy-document_letter_add"></i> Tambah Info</a></th>
		</tr>
	</thead>
	<?php $i = 0 + $offset;?>
	<?php if(!$get_info) {
		/*
		 * Untuk merubah warna jika data kososng sesuai user
		* --------------------------------------------
		* @admin 	: #000000
		* @manajer	: #926737
		*
		*/
		if($this->ion_auth->is_admin())
		{
			echo "<thead><tr style=\"background-color:#000000; color:#FFFFFF;\"><td colspan=\"6\" height=\"13\" style=\"text-align: center\">Data Masih Kosong</td></tr></thead>";
		}else{
			echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"6\" height=\"13\" style=\"text-align: center\">Data Masih Kosong</td></tr></thead>";
		}
	
		} else {
			foreach ($get_info as $row) { ?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$i;?></td>
			<td><?php echo ucfirst($row->nama_konsumen);?></td>
			<td><?php echo ucfirst($row->nama_perawat);?></td>
			<td><?php echo ucwords($row->jenis_rawat);?></td>
			<td><?php echo $row->alamat_konsumen;?></td>
			<td width="80"><a href="<?php echo base_url(); ?>user/manajer/detail_informasi/<?php echo $row->id;?>" class="btn"><i class="icon-eye-open"></i> Detail</a></td>
			<td width="70"><a href="<?php echo base_url(); ?>user/manajer/edit_informasi/<?php echo $row->id;?>" class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a href="<?php echo base_url(); ?>user/manajer/hapus_informasi/<?php echo $row->id;?>" onclick="return confirm('Anda yakin hapus data ini?');" class="btn"><i
					class="icon-trash"></i> Hapus</a></td>
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