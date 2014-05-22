<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Daftar Aturan Fuzzy Rules</h3>
	<span class="pull-right">
	<?php echo form_open('search/aturan', 'cari');?>
		<input  class="pull-right label" type=text name=cari>
		<input class="pull-right label" type=submit value="cari">
	<?php echo form_close()?>
		</span>
	<!-- <span class="pull-right label label-important">NOTIF PELANGGAN LAGI
		ONLINE</span> -->
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
			echo "<thead><tr style=\"background-color:#202123; color:#FFFFFF;\"><td colspan=\"9\" height=\"16\" style=\"text-align: center\">MASTER FUZZY RULES</td></tr></thead>";
		}elseif ($this->ion_auth->in_group('manajer')){
			echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"9\" height=\"16\" style=\"text-align: center\">MASTER FUZZY RULES</td></tr></thead>";
		}else{
			echo "<thead><tr style=\"background-color:#9b262f; color:#FFFFFF;\"><td colspan=\"9\" height=\"16\" style=\"text-align: center\">MASTER FUZZY RULES</td></tr></thead>";
		}
	?>
	<thead>
		<tr style="color: #000;" align="center">
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Keterangan</th>
			<th style="text-align: center;">Nilai</th>
			<th style="text-align: center;" colspan="4"><a
				href="<?php echo site_url('aturan/add');?>" class="btn btn-inverse"><i
					class="splashy-document_letter_add"></i> Tambah Aturan</a></th>
		</tr>
	</thead>
	<?php $no = 0 + $offset;?>
	
	<?php foreach ($results as $row) : ?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$no;?></td>
			<td> <?php echo $row['variabel']; ?></td>
			<td> <?php echo $row['nilai']; ?></td>
			<td width="70"><a href="<?php echo base_url(); ?>aturan/update/<?php echo $row['aturan_id'];?>" class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a href="<?php echo base_url(); ?>aturan/delete/<?php echo $row['aturan_id'];?>" onclick="return confirm('Anda yakin hapus data ini?');" class="btn"><i
					class="icon-trash"></i> Hapus</a></td>
		</tr>
	</tbody>
	<?php endforeach; ?>
</table>
<div class="pagination">
	<ul>
		<?php echo $paging;?>
	</ul>
</div>