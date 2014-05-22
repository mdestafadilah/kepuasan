<?php echo $message; ?>

<div class="heading clearfix">
	<h3 class="pull-left">Daftar Level</h3>
	<span class="pull-right label label-important">NOTIF PENGGUNA LAGI
		ONLINE</span>		
</div>
<table class="table table-bordered table-striped">
	<thead>
		<tr style="background-color: #000000; color: #FFFFFF;">
			<td colspan="9" height="15" style="text-align: center">MASTER LEVEL</td>
		</tr>
	</thead>
	<thead>
		<tr style="color: #000;" align="center">
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Level</th>
			<th style="text-align: center;">Penjelasan</th>
			<th style="text-align: center;" colspan="3"><a
				href="<?php echo base_url(); ?>group/add" class="btn"><i
					class="splashy-document_letter_add"></i> Tambah Data</a></th>
		</tr>
	</thead>
	<?php $i = 0 + $offset;?>
	<?php foreach ($groups as $gr):?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$i; ?></td>
			<td><?php echo $gr->name;?></td>
			<td><?php echo $gr->description;?></td>
			<td width="70"><a
				href="<?php echo base_url(); ?>group/edit/<?php echo $gr->id; ?>"
				class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a
				href="<?php echo base_url(); ?>group/delete/<?php echo $gr->id; ?>"
				onclick="return confirm('Anda yakin?');" class="btn" id="smoke_alert"><i
					class="icon-trash"></i> Hapus</a></td>
		</tr>
	</tbody>
	<?php endforeach;?>
</table>
<h3 class="heading"></h3>
<div class="pagination">
	<ul>
		<?php echo $paging;?>
	</ul>
</div>
<?php
//dump($this->db->last_query());
?>