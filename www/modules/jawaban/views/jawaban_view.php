<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Hasil Jawaban</h3>
	<span class="pull-right"> <?php // echo form_open('jawaban/search', 'cari');
	echo form_open('search/jawaban', 'cari');
	?>
		<input class="pull-right label" type=text name=cari> <input
		class="pull-right label" type=submit value="cari"> <?php echo form_close()?>
	</span>
	<!-- <span class="pull-right label label-important">NOTIF PELANGGAN LAGI
		ONLINE</span> -->
</div>
Dimensi: <br />
<?php echo form_open( current_url() ); ?>
		<?php 
			$dimensi = array(" " => "Semua Kategori");
			$dim = $this->dimensi_model->get_all();
			foreach ($dim as $d)
			{
				$dimensi[$d->dimensi_id] = ucfirst($d->nama);
			}
			 
			echo form_dropdown("dimensi_id", $dimensi, $selected, "onchange='this.form.submit()'") 
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
		echo "<thead><tr style=\"background-color:#202123; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER JAWABAN</td></tr></thead>";
	}elseif ($this->ion_auth->in_group('manajer')){
		echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER JAWABAN</td></tr></thead>";
	}else{
		echo "<thead><tr style=\"background-color:#9b262f; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER JAWABAN</td></tr></thead>";
	}
	?>
	<thead>
		<tr style="color: #000;" align="center">
				<th class="table_checkbox"><input type="checkbox" name="forms[]" class="select_rows" data-tableid="smpl_tbl"/></th>
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Pertanyaan</th>
			<th style="text-align: center;">Akses</th>
			<th style="text-align: center;">Nama Konsumen</th>
			<th style="text-align: center;">Total Score</th>
			<th style="text-align: center;">Total Soal</th>
			<th style="text-align: center;" colspan="4">F.Tahani Process</th>
		</tr>

	</thead>
	<?php $no = 0 + $offset;?>
	<?php
		if ($jawa->num_rows() > 0) {
			foreach ($jawa->result() as $row) { ?>
	<tbody>
		<tr>
			<td><input type="checkbox" name="forms[]" /></td>
			<td style="width: 40px"><?php echo ++$no;?></td>
			<td><?php echo $row->pertanyaan; ?> ?</td>
			<td><?php echo date("j F Y",$row->created);?></td>
			<td><?php echo ucfirst($row->username); ?></td>
			<td><?php echo ucfirst($row->total_nilai); ?></td>
			<td><?php echo ucfirst($row->total_soal); ?></td>
			<td width="80"><a
				href="<?php echo base_url(); ?>jawaban/detail/<?php echo $row->jawaban_id;?>"
				class="btn"><i class="icon-eye-open"></i> Detail</a></td>
			<td width="90">
				<?php echo ($row->status) ? "<a href='jawaban/proses/$row->jawaban_id' class='btn'> <i class='splashy-document_small_download'></i> Proses </a>" : " <i class='splashy-remove'></i> Terproses" ?>		
			</td>			
			<td width="90"><a
				href="<?php echo base_url(); ?>jawaban/delete/<?php echo $row->jawaban_id;?>"
				onclick="return confirm('Anda yakin hapus data ini?');" class="btn"><i
					class="icon-trash"></i> Hapus</a></td>
		</tr>
	</tbody>
	<?php 
		} 
	}else{
		echo "<tr><td colspan='8' align='center'>Pilih Dimensi Kepuasan atau Data Masih Kosong!</td></tr>";	}
	?>
</table>
<form name="forms" action="proses" method="post">
	<input type="submit" value="Process" class="button"/>
</form>
<div class="pagination">
	<ul>
	
		<?php 
		echo $paging;?>
	</ul>
</div>
