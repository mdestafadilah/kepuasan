<?php echo $message; ?>
<div class="heading clearfix">
	<h3 class="pull-left">Pengguna Sistem</h3>
	
	<span class="pull-right">
	<?php echo form_open('user/search', 'cari');?>
		
		<input  class="pull-right label" type=text name=cari>
		<input class="pull-right label" type=submit value="cari">
	<?php echo form_close()?>
		</span>
	</div>
	<table class="table table-bordered table-striped table_vam" id="dt_gal">
	<thead>
		<tr style="background-color: #202123; color: #FFFFFF;">
			<td colspan="9" height="15" style="text-align: center">MASTER
				PENGGUNA</td>
		</tr>
	</thead>
	<thead>
		<tr style="color: #000;" align="center">
			<th style="text-align: center;" class="sorting">No</th>
			<th style="text-align: center;">Username</th>
			<th style="text-align: center;">Email</th>
			<th style="text-align: center;"><a href="<?=site_url('group');?>">Groups</a></th>
			<th style="text-align: center;" colspan="2">Aktif | Aksi</th>
			<div class="btn-group">
			<th style="text-align: center;" colspan="3">
				<?php
					$attr = array(
								'class' => 'btn',
							); 
					echo anchor($uri="user/new_admin", $title="<i class='splashy-document_letter_add'></i> Admin", $attr);
					echo anchor($uri="user/new_manajer", $title="<i class='splashy-document_letter_add'></i> Manajer", $attr);
					echo anchor($uri="user/new_direktur", $title="<i class='splashy-document_letter_add'></i> Direktur", $attr);
					?>
			</th>
			</div>
		</tr>
	</thead>
	<?php $i = 0 + $offset;?>
	<?php foreach ($users as $user):?>
	<tbody>
		<tr>
			<td style="width: 40px"><?php echo ++$i; ?></td>
			<td><?php echo ucfirst($user->username);?></td>
			<td><?php echo $user->email;?></td>
			<td><?php foreach ($user->groups as $group):?> <?php echo ucfirst($group->name);?><br />
				<?php endforeach?>
			</td>
			<td width="40">
				<?php echo ($user->active) ? '<i class="splashy-check"></i>' : '<i class="splashy-remove"></i>';?> </td>
			<td width="90">
				<?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, '<i class="splashy-remove"></i> Deactivate') : anchor("auth/activate/". $user->id, '<i class="splashy-check"></i> Aktivate'); ?>
			</td>

			<td width="80"><a
				href="<?php echo base_url(); ?>user/detail_user/<?php echo $user->id; ?>"
				class="btn"><i class="icon-eye-open"></i> Detail</a></td>
			<td width="75"><a
				href="<?php echo base_url(); ?>user/edit_user/<?php echo $user->id; ?>"
				class="btn"><i class="icon-pencil"></i> Edit</a></td>
			<td width="80"><a
				href="<?php echo base_url(); ?>user/hapus_user/<?php echo $user->id; ?>"
				onclick="return confirm('Anda yakin?');" class="btn" id="smoke_alert"><i
					class="icon-trash"></i> Hapus</a></td>
			<?php // echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Tidak Aktif') : anchor("auth/activate/". $user->id, 'Aktif'); ?>
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
// dump($this->db->last_query());
// dump($this->db->affected_rows());
?>


