<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Daftar Pertanyaan</h3>
	<span class="pull-right">
	<?php //echo form_open('soal/search', 'cari');
	echo form_open('search/soal', 'cari');
	?>
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
			echo "<thead><tr style=\"background-color:#202123; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER SOAL</td></tr></thead>";
		}elseif ($this->ion_auth->in_group('manajer')){
			echo "<thead><tr style=\"background-color:#926737; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER SOAL</td></tr></thead>";
		}else{
			echo "<thead><tr style=\"background-color:#9b262f; color:#FFFFFF;\"><td colspan=\"10\" height=\"16\" style=\"text-align: center\">MASTER SOAL</td></tr></thead>";
		}
	?>
	<thead>
		<tr style="color: #000;" align="center">
			<th class="table_checkbox"></th>
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Pertanyaan</th>
			<th style="text-align: center;">Faktor</th>
			<th style="text-align: center;">Dimensi/ Variabel</th>
			<th style="text-align: center;"  colspan="2">Status | Aksi</th>
			<?php 
			$x = $this->ion_auth->in_group('manajer') || $this->ion_auth->is_admin();
			$y = $this->ion_auth->in_group('direktur');
			echo  ($x == TRUE) ? "<th style='text-align: center;' colspan='4'><a href='soal/add' class='btn btn-inverse'><i class='splashy-document_letter_add'></i> Tambah Data</a></th>" : 
				( ($y == TRUE) ? "<th style='text-align: center;' colspan='4'> Aksi </th>" : "None" );

			// echo ($x == TRUE) ? "One" : ( ($y==2) ? "Two" : "None" );
			?>
			<!-- 
			<th style="text-align: center;" colspan="4"><a
				href="<?php echo site_url('soal/add');?>" class="btn btn-inverse"><i
					class="splashy-document_letter_add"></i> Tambah Data</a></th>
			-->
		</tr>
		
	</thead>
	<?php $no = 0 + $offset;?>
	<?php foreach ($results as $row) : ?>
	<tbody>
		<tr>
			<td> <?php echo form_checkbox('banksoal_id[]', $row->banksoal_id); ?></td>
			<td style="width: 40px"><?php echo ++$no;?></td>
			<td> <?php echo $row->pertanyaan; ?></td>
			<td> <?php echo $row->faktor; ?></td>
			<td> <?php echo $row->dimensi->nama; ?></td>
			<td  width="40"> <?php echo ($row->publish) ? '<i class="splashy-check"></i> ' : '<i class="splashy-remove"></i>';?> </td>
			<td width="90">
				<?php echo ($row->publish) ? anchor("soal/do_unpublish/".$row->banksoal_id, '<i class="splashy-remove"></i> Unpublish') : anchor("soal/do_publish/". $row->banksoal_id, '<i class="splashy-check"></i> Publish'); ?>
			</td>
			<?php
			$x = $this->ion_auth->in_group('manajer') || $this->ion_auth->is_admin();
			echo ($x == TRUE) ? 
			"<td width='70'><a href='soal/update/$row->banksoal_id' class='btn'><i class='icon-pencil'></i> Edit</a></td>
			 <td width='80'><a href='soal/delete/$row->banksoal_id' onclick=\"return confirm('Anda yakin hapus data ini?');\" class='btn'><i
					class='icon-trash'></i> Hapus</a></td>" : "<td width='80'><a class='btn'><i class='splashy-remove'></i> None</a></td>";
			?>
			<!-- 
			<td width="70"><a href="<?php echo base_url(); ?>soal/update/<?php echo $row->banksoal_id;?>" class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a href="<?php echo base_url(); ?>soal/delete/<?php echo $row->banksoal_id;?>" onclick="return confirm('Anda yakin hapus data ini?');" class="btn"><i
					class="icon-trash"></i> Hapus</a></td>
			-->
		</tr>
	</tbody>
	<?php endforeach; ?>
</table>
<form name="forms" action="delete" method="post">
	<input type="submit" value="delete" onclick="return confirm('are you sure ?')" class="button"/>
</form>
<div class="pagination">
	<ul>
		<?php echo $paging;?>
	</ul>
</div>